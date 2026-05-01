import styled from "styled-components";

export const CartOverlayContainer = styled.div`
  max-width: 32.5rem;
  padding: 3.2rem 1.6rem;
  max-height: 63rem;
  width: 100%;
  background-color: #fff;
  position: absolute;
  top: 100%;
  right: 0;
  display: flex;
  flex-direction: column;
  gap: 3.2rem;
  z-index: 99999;

  @media (max-width: 768px) {
    max-width: 100%;
    padding: 3.2rem 0;
    max-height: auto;
  }
`;

export const CartHeader = styled.p`
  font-size: var(--text-standard-size);
  font-weight: bold;

  @media (max-width: 768px) {
    padding: 0 2.4rem;
  }
`;

export const CartItemsContainer = styled.div`
  display: flex;
  flex-direction: column;
  gap: 4rem;
  overflow-y: auto;
  overflow-x: hidden;

  /* Firefox */
  scrollbar-width: none;

  /* Chrome, Safari, Edge */
  &::-webkit-scrollbar {
    display: none;
  }

  @media (max-width: 768px) {
    padding: 0 2.4rem;
    max-height: 20rem;
  }
`;

export const CartTotalContainer = styled.div`
  display: flex;
  justify-content: space-between;
  font-weight: 700;
  font-size: var(--text-standard-size);

  @media (max-width: 768px) {
    padding: 0 2.4rem;
  }
`;

export const EmptyCartMessage = styled.p`
  font-size: 1.4rem;

  @media (max-width: 768px) {
    padding: 0 2.4rem;
  }
`;
