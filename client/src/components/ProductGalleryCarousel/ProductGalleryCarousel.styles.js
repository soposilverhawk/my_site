import styled from "styled-components";

export const CarouselContainer = styled.div`
  width: 100%;
  position: relative;
  background-image: ${({ $activeImg }) => `url(${$activeImg})`};
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;

  @media (max-width: 768px) {
    height: 70%;
  }
`;

export const NavigationButton = styled.button`
  width: 3.2rem;
  height: 3.2rem;
  background-color: #000000ba;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  transition: transform 0.2s ease;
  border: none;

  &:hover {
    transform: scale(1.2);
  }
`;
