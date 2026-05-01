import React from "react";
import {
  ProductSideGalleryContainer,
  ProductImageButton,
  ProductImage,
} from "./ProductSideGallery.styles";

function ProductSideGalleryView({ productGallery, setActiveImgIndex }) {
  return (
    <ProductSideGalleryContainer>
      {productGallery?.map((image, idx) => (
        <ProductImageButton
          key={`product-img-${idx}`}
          onClick={() => setActiveImgIndex(idx)}
        >
          <ProductImage src={image} />
        </ProductImageButton>
      ))}
    </ProductSideGalleryContainer>
  );
}

export default ProductSideGalleryView;
