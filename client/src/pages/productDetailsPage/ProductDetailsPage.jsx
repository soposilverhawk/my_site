import React, { useState } from "react";
import { useParams } from "react-router-dom";
import { useQuery } from "@apollo/client/react";
import {
  ProductPageSection,
  GalleryViewContainer,
} from "./ProductDetailsPage.styles";
import ProductGalleryCarousel from "../../components/ProductGalleryCarousel/ProductGalleryCarousel";
import ProductDetailsContainer from "../../components/ProductDetailsContainer/ProductDetailsContainer";
import ProductSideGallery from "../../components/ProductSideGalleryView/ProductSideGalleryView";
import { GET_PRODUCT } from "../../api/queries";

function ProductDetailsPage() {
  const { id } = useParams();
  const { loading, error, data } = useQuery(GET_PRODUCT, {
    variables: {
      id: Number(id),
    },
  });
  const [activeImgIndex, setActiveImgIndex] = useState(0);
  const productGallery = data?.product?.product_gallery || [];

  if (loading) return <p>Loading...</p>;
  if (error) return <p>Error: {error.message}</p>;

  return (
    <ProductPageSection>
      <GalleryViewContainer data-testid="product-gallery">
        <ProductSideGallery
          productGallery={productGallery}
          setActiveImgIndex={setActiveImgIndex}
        />
        <ProductGalleryCarousel
          productGallery={productGallery}
          activeImgIndex={activeImgIndex}
          setActiveImgIndex={setActiveImgIndex}
        />
      </GalleryViewContainer>
      <ProductDetailsContainer
        variant="pdp"
        product={data?.product}
      />
    </ProductPageSection>
  );
}

export default ProductDetailsPage;
