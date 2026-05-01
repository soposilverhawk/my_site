import React from "react";
import { useQuery } from "@apollo/client/react";
import { useParams } from "react-router-dom";
import {
  CategoryPageContainer,
  CategoryHeading,
  ProductsContainer,
} from "./CategoryPage.styles";
import capitalizeString from "../../utils/capitalizeString";
import ProductCard from "../../components/ProductCard/ProductCard";
import { GET_PRODUCTS_BY_CATEGORY } from "../../api/queries";


function CategoryPage() {
  const { categoryName } = useParams();
  const { loading, error, data } = useQuery(GET_PRODUCTS_BY_CATEGORY, {
    variables: { category: categoryName },
  });

  if (loading) return <p>Loading...</p>;
  if (error) return <p>Error: {error.message}</p>;

  return (
    <CategoryPageContainer>
      <CategoryHeading>{capitalizeString(categoryName)}</CategoryHeading>
      <ProductsContainer>
        {data.products.map(
          (product) => (
            <ProductCard
              product={product}
              key={product?.product_uid}
            />
          ),
        )}
      </ProductsContainer>
    </CategoryPageContainer>
  );
}

export default CategoryPage;
