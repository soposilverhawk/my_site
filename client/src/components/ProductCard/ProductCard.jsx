import React, { useEffect, useState } from "react";
import {
  ProductListItem,
  ProductLink,
  ProductImageContainer,
  ProductImage,
  ProductInformationContainer,
  ProductInformationBase,
  ProductInformationPrice,
  OutOfStockOverlay,
  OutOfStockMessage,
} from "./ProductCard.styles";
import QuickShopButton from "../Shared/CartButton/CartButton";
import formatStringToKebabCase from "../../utils/formatStringToKebabCase";
import { usePricesMap } from "../../hooks/usePricesMap";
import { useCart } from "../../context/CartContext";

function ProductCard({ product }) {
  const {
    product_uid,
    id,
    name,
    product_gallery,
    product_attributes,
    product_prices,
    in_stock,
  } = product;
  const { amount, currency } = usePricesMap(product_prices);
  const { addToCart } = useCart();

  const handleQuickShop = (e) => {
    e.preventDefault();
    e.stopPropagation();

    const defaultAttributes = {};
    product_attributes?.forEach((attribute) => {
      defaultAttributes[attribute.name] =
        attribute.product_attribute_items[0]?.attribute_item_value;
    });
    addToCart(product, defaultAttributes);
  };

  return (
    <ProductListItem data-testid={`product-${formatStringToKebabCase(name)}`}>
      <ProductLink to={`/product/${id}`}>
        <ProductImageContainer>
          <ProductImage src={product_gallery[0]} alt={name} />
          {in_stock ? (
            <QuickShopButton
              variant="quickshop"
              onClick={(e) => handleQuickShop(e)}
            />
          ) : (
            <OutOfStockOverlay>
              <OutOfStockMessage>OUT OF STOCK</OutOfStockMessage>
            </OutOfStockOverlay>
          )}
        </ProductImageContainer>
        <ProductInformationContainer $isInStock={in_stock}>
          <ProductInformationBase>{name}</ProductInformationBase>
          <ProductInformationPrice>
            {`${currency}${amount}`}
          </ProductInformationPrice>
        </ProductInformationContainer>
      </ProductLink>
    </ProductListItem>
  );
}

export default ProductCard;
