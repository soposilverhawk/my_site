import styled from "styled-components";

export const CartItemControlButton = styled.button`
  width: 2.4rem;
  height: 2.4rem;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid var(--secondary-color);
  background-color: transparent;
  cursor: pointer;
  transition: color, background-color 0.2s ease;

  &:hover {
    background-color: var(--secondary-color);
    color: #fff;
  }
`;
