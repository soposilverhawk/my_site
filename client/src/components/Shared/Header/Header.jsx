import React, { useEffect, useState } from "react";
import logo from "../../../assets/logo/logo.png";
import HeaderNavigation from "../../HeaderNavigation/HeaderNavigation";
import CartButton from "../CartButton/CartButton";
import { StyledHeader, HomeButton, HeaderInner } from "./Header.styles";
import { useNavigate } from "react-router-dom";
import ROUTES from "../../../routes/Routes";
import CartOverlay from "../../CartOverlay/CartOverlay";
import ContentWrapper from "../ContentWrapper/ContentWrapper";

function Header({ isCartOpen }) {
  const navigate = useNavigate();
  const [isScrolled, setIsScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 100);
    };

    window.addEventListener("scroll", handleScroll);

    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  return (
    <StyledHeader $isScrolled={isScrolled}>
      <ContentWrapper>
        <HeaderInner>
          <HeaderNavigation />
          <HomeButton onClick={() => navigate(ROUTES.HOME)}>
            <img src={logo} alt="Green shopping bag - app logo" />
          </HomeButton>
          <CartButton />
          {isCartOpen && <CartOverlay />}
        </HeaderInner>
      </ContentWrapper>
    </StyledHeader>
  );
}

export default Header;
