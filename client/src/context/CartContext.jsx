import { createContext, useContext, useMemo, useState } from "react";
import { useLocalStorage } from "../hooks/useLocalStorage";
import createPricesMap from "../utils/createPricesMap";

const CartContext = createContext();

export const CartProvider = ({ children }) => {
  const [cart, setCart] = useLocalStorage("cart", []);
  const [isCartOpen, setIsCartOpen] = useState(false);

  const getCartItemKey = (productId, selectedAttributes) =>
    `${productId}-${JSON.stringify(selectedAttributes)}`;

  const addToCart = (product, selectedAttributes) => {
    setCart((prev) => {
      const key = getCartItemKey(product.id, selectedAttributes);

      const existingItem = prev.find((item) => item.key === key);

      if (existingItem) {
        return prev.map((item) =>
          item.key === key ? { ...item, quantity: item.quantity + 1 } : item,
        );
      }

      return [
        ...prev,
        {
          key,
          ...product,
          selectedAttributes,
          quantity: 1,
        },
      ];
    });
  };

  const decreaseQuantity = (key) => {
    setCart((prev) =>
      prev
        .map((item) =>
          item.key === key ? { ...item, quantity: item.quantity - 1 } : item,
        )
        .filter((item) => item.quantity > 0),
    );
  };

  const increaseQuantity = (key) => {
    setCart((prev) =>
      prev.map((item) =>
        item.key === key ? { ...item, quantity: item.quantity + 1 } : item,
      ),
    );
  };

  const calculateTotalCost = useMemo(() => {
    return cart.reduce((totalPrice, item) => {
      const pricesMap = createPricesMap(item.product_prices);
      const itemPrice = pricesMap["$"] ?? Object.values(pricesMap)[0] ?? 0;
      return totalPrice + itemPrice * item.quantity
    }, 0);
  }, [cart]);

  const calculateTotalItems = useMemo(() => {
    return cart.reduce((totalItems, item) => {
      return totalItems + item.quantity
    }, 0)
  }, [cart])

  const clearCart = () => setCart([]);

  return (
    <CartContext.Provider
      value={{
        cart,
        isCartOpen,
        setIsCartOpen,
        addToCart,
        decreaseQuantity,
        increaseQuantity,
        calculateTotalCost,
        calculateTotalItems,
        clearCart,
      }}
    >
      {children}
    </CartContext.Provider>
  );
};

export const useCart = () => useContext(CartContext);
