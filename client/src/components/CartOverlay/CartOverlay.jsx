import React, { useEffect } from "react";
import { useCart } from "../../context/CartContext";
import ProductDetailsContainer from "../ProductDetailsContainer/ProductDetailsContainer";
import {
  CartOverlayContainer,
  CartHeader,
  CartItemsContainer,
  CartTotalContainer,
  EmptyCartMessage,
} from "./CartOverlay.styles";
import CartItem from "../CartItem/CartItem";
import ActionButton from "../Shared/ActionButton/ActionButton";
import { usePrefferedCurrency } from "../../context/PrefferedCurrencyContext";
import { useMutation } from "@apollo/client/react";
import { PLACE_ORDER } from "../../api/mutations";

function CartOverlay() {
  const {
    cart,
    calculateTotalCost,
    calculateTotalItems,
    clearCart,
    setIsCartOpen,
  } = useCart();
  const { currency } = usePrefferedCurrency();
  const [placeOrder, { data, loading, error }] = useMutation(PLACE_ORDER);

  const handlePlaceOrder = () => {
    placeOrder({
      variables: {
        items: cart.map((item) => ({
          id: item.id,
          qty: item.quantity,
          selected_options: Object.entries(item.selectedAttributes).map(
            ([name, value]) => ({
              name,
              value,
            }),
          ),
        })),
      },
    });
    clearCart();
  };

  return (
    <CartOverlayContainer data-testid="cart-overlay">
      <CartHeader>
        My bag,
        <span>
          {` ${calculateTotalItems} `}
          {calculateTotalItems === 1 ? "item" : "items"}
        </span>
      </CartHeader>
      {cart.length === 0 ? (
        <EmptyCartMessage>The cart is empty...</EmptyCartMessage>
      ) : (
        <CartItemsContainer>
          {cart?.map((cartItem) => (
            <CartItem item={cartItem} key={cartItem?.key} />
          ))}
        </CartItemsContainer>
      )}
      <CartTotalContainer>
        <p>Total</p>
        <span data-testid="cart-total">
          {currency}
          {calculateTotalCost.toFixed(2)}
        </span>
      </CartTotalContainer>
      <ActionButton
        variant="place-order"
        onclick={handlePlaceOrder}
        disabled={cart.length === 0}
      >
        Place order
      </ActionButton>
    </CartOverlayContainer>
  );
}

export default CartOverlay;
