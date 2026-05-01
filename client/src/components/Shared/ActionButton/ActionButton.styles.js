import styled from "styled-components";

export const StyledActionButton = styled.button`
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 1.6rem 3.2rem;
  background-color: var(--primary-color);
  color: #fff;
  font-size: ${({ $variant }) =>
    $variant === "add-to-cart" ? "1.6rem" : "1.4rem"};
  text-transform: uppercase;
  cursor: pointer;
  border: none;
  transition: background-color 0.1s ease;

  &:hover:not(:disabled) {
    background-color: #048354;
  }

  &:disabled {
    background-color: #39374838;
    color: #777;
    cursor: not-allowed;
    opacity: 0.8;
  }
`;
