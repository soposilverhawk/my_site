import styled from "styled-components";
import { css } from "styled-components";

const flexColumn = css`
  display: flex;
  flex-direction: column;
`;

export const CartItemContainer = styled.div`
  display: flex;
  justify-content: space-between;
  font-size: 1.4rem;
`;

export const ItemInfoContainer = styled.div`
  ${flexColumn}
  gap: 1rem;
`;

export const ItemEssentialsContainer = styled.div`
  ${flexColumn}
`;

export const ItemName = styled.p`
  font-size: var(--product-details-text);
`;

export const ItemControlsContainer = styled.div`
  ${flexColumn};
  justify-content: space-between;
  align-items: center;
`;

export const ItemAmountDisplay = styled.span``;

export const ItemImageContainer = styled.div`
  max-width: 12.1rem;
  width: 100%;
  height: 100%;
`;

export const ItemImage = styled.img`
  width: 100%;
  height: 100%;
`;
