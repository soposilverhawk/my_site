import styled, { css } from "styled-components";

export const StyledAttributesContainer = styled.div`
  display: flex;
  flex-direction: column;
  gap: ${({ $variant }) => ($variant === "pdp" ? "2rem" : "1.2rem")};
  font-size: ${({ $variant }) =>
    $variant === "pdp" ? "var(--product-details-text)" : "1.4rem"};
  font-weight: ${({ $variant }) => ($variant === "pdp" ? 700 : 300)};
`;

export const AttributeContainer = styled.div`
  display: flex;
  flex-direction: column;
  gap: 2rem;
`;

export const AttributeSelectablesContainer = styled.ul`
  display: flex;
  gap: ${({ $variant }) => ($variant === "pdp" ? "1.2rem" : "0.8rem")};
`;

export const AttributeSelectableButton = styled.button`
  font-size: ${({ $variant }) =>
    $variant === "pdp" ? "var(--text-standard-size)" : "1.4rem"};
  padding: ${({ $variant }) =>
    $variant === "pdp" ? "1.3rem 2.3rem" : "0.2rem 0.5rem"};
  cursor: pointer;

  width: ${({ $attributeType, $variant }) =>
    $attributeType === "swatch"
      ? $variant === "pdp"
        ? "3.6rem"
        : "2rem"
      : "auto"};

  height: ${({ $attributeType, $variant }) =>
    $attributeType === "swatch"
      ? $variant === "pdp"
        ? "3.6rem"
        : "2rem"
      : "auto"};

  border: ${({ $attributeType, $active }) =>
    $attributeType === "swatch"
      ? $active
        ? "2px solid var(--primary-color)"
        : "2px solid #c4c4c4"
      : $active
        ? "1px solid black"
        : "1px solid var(--secondary-color)"};

  background-color: ${({ $attributeType, $attribute_item_value, $active }) =>
    $attributeType === "swatch"
      ? $attribute_item_value
      : $active
        ? "black"
        : "transparent"};

  color: ${({ $attributeType, $active }) =>
    $attributeType === "swatch" ? "transparent" : $active ? "#fff" : "inherit"};

  ${({ $attributeType, $variant }) =>
    $variant === "pdp"
      ? $attributeType === "swatch"
        ? css`
            &:hover {
              border: 2px solid var(--primary-color);
            }
          `
        : css`
            &:hover {
              background-color: var(--secondary-color);
              color: #fff;
            }
          `
      : ""}

  &:disabled {
    cursor: not-allowed;
    opacity: 0.8;
  }
`;
