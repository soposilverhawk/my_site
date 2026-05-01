import styled from "styled-components";

export const ProductSideGalleryContainer = styled.div`
  max-width: 8rem;
  width: 100%;
  overflow-y: auto;
  overflow-x: hidden;
  display: flex;
  flex-direction: column;
  gap: 2rem;

  /* Firefox */
  scrollbar-width: none;

  /* Chrome, Safari, Edge */
  &::-webkit-scrollbar {
    display: none;
  }

  @media (max-width: 768px) {
    flex-direction: row;
    max-width: 100%;
  }
`;

export const ProductImageButton = styled.button`
  width: 100%;
  max-height: 8rem;
  height: 100%;
  cursor: pointer;
  border: none;
  background: transparent;
  transition: transform 0.2s ease;

  &:hover {
    transform: scale(1.2);
  }

  @media (max-width: 768px) {
    max-width: 8rem;
  }
`;

export const ProductImage = styled.img`
  width: 100%;
  height: 100%;
  object-fit: cover;
`;
