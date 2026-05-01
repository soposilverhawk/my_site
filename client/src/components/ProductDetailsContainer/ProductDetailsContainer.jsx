import React, { useState } from "react";
import {
  ProductDescriptionContainer,
  ProductName,
  ProductPriceDisplay,
  ProductDescriptionDisplay,
} from "./ProductDetailsContainer.styles";
import AttributeList from "../AttributeList/AttributeList";
import ActionButton from "../Shared/ActionButton/ActionButton";
import { usePricesMap } from "../../hooks/usePricesMap";
import { StyledAttributesContainer } from "../AttributeList/AttributeList.styles";
import { useParseHTML } from "../../hooks/useParseHTML";
import { useCart } from "../../context/CartContext";

function ProductDetailsContainer({ variant, product }) {
  const { amount, currency } = usePricesMap(product?.product_prices);
  const parsedProductDescription = useParseHTML(product?.description);
  const [selectedAttributes, setSelectedAttributes] = useState({});
  const { cart, addToCart, setIsCartOpen } = useCart();
  const isSelectedAttributesEmpty =
    product?.product_attributes?.length > 0 &&
    Object.keys(selectedAttributes).length === 0;

  const handleAddToCart = () => {
    addToCart(product, selectedAttributes);
    setIsCartOpen(true);
    setSelectedAttributes({});
  };

  return (
    <ProductDescriptionContainer>
      <ProductName>{product?.name}</ProductName>
      <AttributeList
        variant={variant}
        productAttributesData={product?.product_attributes}
        selectedAttributes={selectedAttributes}
        setSelectedAttributes={setSelectedAttributes}
      />
      <StyledAttributesContainer $variant={variant}>
        <p>Price:</p>
        <ProductPriceDisplay>{`${currency}${amount}`}</ProductPriceDisplay>
      </StyledAttributesContainer>
      <ActionButton
        variant="add-to-cart"
        onclick={handleAddToCart}
        disabled={!product.in_stock || isSelectedAttributesEmpty}
      >
        Add to cart
      </ActionButton>
      <ProductDescriptionDisplay data-testid="product-description">
        {parsedProductDescription}
      </ProductDescriptionDisplay>
    </ProductDescriptionContainer>
  );
}

export default ProductDetailsContainer;
