import styled, { css } from "styled-components";
import { Link } from "react-router-dom";
import { QuickShopCartButton } from "../Shared/CartButton/CartButton.styles";

const flexColumn = css`
  display: flex;
  flex-direction: column;
`;

export const ProductListItem = styled.li`
  max-width: 38.6rem;
  max-height: 44.4rem;
  width: 100%;
  height: 100%;
  padding: 1.6rem;
  gap: 2.4rem;
  transition: box-shadow 0.5s ease;

  &:hover {
    box-shadow: 0 0.4rem 3rem 0 var(--tertiary-color);
  }

  &:hover ${QuickShopCartButton} {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
  }
`;

export const ProductLink = styled(Link)`
  ${flexColumn}
  gap: 1rem;
`;

export const ProductImageContainer = styled.div`
  height: 40rem;
  position: relative;
`;

export const ProductImage = styled.img`
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: 50% 10%;

  @media (max-width: 768px) {
    object-fit: contain;
  }
`;

export const ProductInformationContainer = styled.div`
  ${flexColumn};
  color: ${({ $isInStock }) =>
    $isInStock ? "var(--secondary-color)" : "var(--out-of-stock-color)"};
  gap: 0.5rem;
  font-size: var(--product-details-text);
`;

export const ProductInformationBase = styled.p`
  font-weight: 300;
`;

export const ProductInformationPrice = styled(ProductInformationBase)`
  font-weight: 400;
`;

export const OutOfStockOverlay = styled.div`
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: #ffffff;
  opacity: 0.5;
  display: flex;
  justify-content: center;
  align-items: center;
`;

export const OutOfStockMessage = styled.p`
  font-size: var(--out-of-stock-text-size);
  color: black;
`;
