import React from "react";
import cartHeaderIcon from "../../../assets/cart/cart-icon-black.png";
import cartProductCardIconfrom from "../../../assets/cart/cart-icon-white.png";
import {
  CartButtonDefault,
  QuickShopCartButton,
  CartItemsQtyDisplay,
} from "../CartButton/CartButton.styles";
import { useCart } from "../../../context/CartContext";

function CartButton({ variant = "defaultEmpty", onClick }) {
  const { cart, setIsCartOpen, calculateTotalItems } = useCart();
  const handleCartOverlayToggle = () => {
    setIsCartOpen((prev) => !prev)
  }

  return variant === "defaultEmpty" ? (
    <CartButtonDefault onClick={handleCartOverlayToggle} data-testid="cart-btn">
      <img src={cartHeaderIcon} alt="cart" />
      {cart.length !== 0 && (
        <CartItemsQtyDisplay>{calculateTotalItems}</CartItemsQtyDisplay>
      )}
    </CartButtonDefault>
  ) : (
    <QuickShopCartButton onClick={onClick}>
      <img src={cartProductCardIconfrom} alt="cart" />
    </QuickShopCartButton>
  );
}

export default CartButton;
