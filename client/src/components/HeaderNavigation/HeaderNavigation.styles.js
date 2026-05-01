import styled from "styled-components";

export const StyledUL = styled.ul`
  display: flex;
  gap: 1.6rem;
  font-size: var(--text-standard-size);
`;

export const StyledListItem = styled.li`
  padding-bottom: 1rem;
  position: relative;
  cursor: pointer;

  &:hover {
    color: var(--primary-color);
  }

  &::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 0.2rem;
    width: 0%;
    background-color: var(--primary-color);
    transition: width 0.3s ease;
  }

  &:hover::after {
    width: 100%;
  }
`;
