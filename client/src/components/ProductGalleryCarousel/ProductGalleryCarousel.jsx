import React, { useState } from "react";
import {
  CarouselContainer,
  NavigationButton,
} from "./ProductGalleryCarousel.styles";
import prevArrow from "../../assets/galleryCarousel/prev-arrow.png";
import nextArrow from "../../assets/galleryCarousel/next-arrow.png";

function ProductGalleryCarousel({ productGallery, activeImgIndex, setActiveImgIndex }) {
  const activeImg = productGallery?.[activeImgIndex];
  const handleNavigation = (direction) => {
    if (!productGallery?.length) return;

    setActiveImgIndex((prev) => {
      if (direction === "next") {
        return (prev + 1) % productGallery.length;
      }

      if (direction === "prev") {
        return (prev - 1 + productGallery.length) % productGallery.length;
      }

      return prev;
    });
  };
  return (
    <CarouselContainer $activeImg={activeImg}>
      <NavigationButton onClick={() => handleNavigation("prev")}>
        <img src={prevArrow} alt="Previous image" />
      </NavigationButton>
      <NavigationButton onClick={() => handleNavigation("next")}>
        <img src={nextArrow} alt="Next image" />
      </NavigationButton>
    </CarouselContainer>
  );
}

export default ProductGalleryCarousel;
