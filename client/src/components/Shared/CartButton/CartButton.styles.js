import styled from "styled-components";

const ButtonBase = styled.button`
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  border: none;
`;

export const CartButtonDefault = styled(ButtonBase)`
  width: 2rem;
  height: 2rem;
  background: none;
  position: relative;
`;

export const QuickShopCartButton = styled(ButtonBase)`
  width: 5.2rem;
  height: 5.2rem;
  border-radius: 50%;
  background-color: var(--primary-color);
  position: absolute;
  right: 0;
  bottom: 0;
  transform: translate(-25%, 25%);
  opacity: 0;
  visibility: hidden;
  transition: background-color 0.1s ease;
  pointer-events: none;

  &:hover {
    background-color: #048354;
  }
`;

export const CartItemsQtyDisplay = styled.div`
  width: 2rem;
  height: 2rem;
  background-color: var(--secondary-color);
  color: #fff;
  border-radius: 50%;
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
  top: 0;
  right: 0;
  transform: translate(70%, -40%);
`;
