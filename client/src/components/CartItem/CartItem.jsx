import React from "react";
import {
  CartItemContainer,
  ItemInfoContainer,
  ItemEssentialsContainer,
  ItemName,
  ItemControlsContainer,
  ItemAmountDisplay,
  ItemImageContainer,
  ItemImage,
} from "./CartItem.styles";
import CartItemQuantityButton from "../CartItemQuantityButtons/CartItemQtyControlButton";
import AttributeList from "../AttributeList/AttributeList";
import { usePricesMap } from "../../hooks/usePricesMap";
import { StyledAttributesContainer } from "../AttributeList/AttributeList.styles";
import { useCart } from "../../context/CartContext";

function CartItem({ item }) {
  const { amount, currency } = usePricesMap(item?.product_prices);
  const { decreaseQuantity, increaseQuantity } = useCart();

  return (
    <CartItemContainer>
      <ItemInfoContainer>
        <StyledAttributesContainer $variant="cart-overlay">
          <p>{item.name}</p>
          <p>
            {currency}
            {amount}
          </p>
        </StyledAttributesContainer>
        <AttributeList
          variant="cart-overlay"
          productAttributesData={item?.product_attributes}
          selectedAttributes={item?.selectedAttributes}
        />
      </ItemInfoContainer>
      <ItemControlsContainer>
        <CartItemQuantityButton variant="increase" onClick={() => increaseQuantity(item?.key)}>
          +
        </CartItemQuantityButton>
        <ItemAmountDisplay data-testid="cart-item-amount">{item?.quantity}</ItemAmountDisplay>
        <CartItemQuantityButton variant="decrease" onClick={() => decreaseQuantity(item?.key)}>
          -
        </CartItemQuantityButton>
      </ItemControlsContainer>
      <ItemImageContainer>
        <ItemImage src={item?.product_gallery[0]} alt={item?.name} />
      </ItemImageContainer>
    </CartItemContainer>
  );
}

export default CartItem;
