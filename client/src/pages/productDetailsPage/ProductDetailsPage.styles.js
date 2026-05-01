import styled from "styled-components";

export const ProductPageSection = styled.section`
  margin-top: 8rem;
  display: flex;
  column-gap: 11rem;

  @media (max-width: 768px) {
    flex-direction: column;
    align-items: center;
    margin-top: 1rem;
  }
`;

export const GalleryViewContainer = styled.div`
  max-width: 60%;
  max-height: 47.8rem;
  height: 47.8rem;
  width: 100%;
  gap: 15rem;
  display: flex;

  @media (max-width: 768px) {
    max-width: 100%;
    display: flex;
    flex-direction: column;
    gap: 3rem;
    max-height: 40rem;
  }
`;
