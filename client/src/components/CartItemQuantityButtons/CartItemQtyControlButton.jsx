import React, { useEffect } from "react";
import { CartItemControlButton } from "./CartItemQtyControlButton.styles";
import { useCart } from "../../context/CartContext";

function CartItemQuantityButton({ children, onClick, variant }) {
  return (
    <CartItemControlButton
      onClick={onClick}
      data-testid={`cart-item-amount-${variant}`}
    >
      {children}
    </CartItemControlButton>
  );
}

export default CartItemQuantityButton;
