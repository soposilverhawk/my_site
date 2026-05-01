import styled from "styled-components";

export const ProductDescriptionContainer = styled.div`
  display: flex;
  flex-direction: column;
  row-gap: 4rem;
  max-width: 29.2rem;
  min-height: 100%;
  overflow-y: auto;
  overflow-x: hidden;

  /* Firefox */
  scrollbar-width: none;

  /* Chrome, Safari, Edge */
  &::-webkit-scrollbar {
    display: none;
  }
`;

export const ProductName = styled.p`
  font-size: 3rem;
  font-weight: 600;
  color: var(--secondary-color);
`;

export const ProductPriceDisplay = styled.span`
  font-size: 2.4rem;
  font-weight: 700;
`;

export const ProductDescriptionDisplay = styled.div`
  font-size: var(--text-standard-size);
  max-height: 10rem;

  line-height: 1.6;

  p {
    font-size: 1.6rem;
    margin: 2rem 0;
  }

  ul,
  ol {
    list-style: disc;
    list-style-position: inside;
    margin: 1rem 0;
  }

  li {
    margin-bottom: 0.8rem;
  }

  h1,
  h3 {
    font-weight: bold;
    font-size: var(--product-details-text);
  }
`;
