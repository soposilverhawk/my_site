import { gql } from "@apollo/client";

export const GET_CATEGORIES = gql`
  query GetCategories {
    categories {
      id
      name
    }
  }
`;

export const GET_PRODUCTS_BY_CATEGORY = gql`
  query GetProductsByCategory($category: String!) {
    products(category: $category) {
      id
      product_uid
      name
      in_stock
      product_gallery
      product_prices {
        amount
        currency_symbol
      }
      product_attributes {
        attribute_id
        type
        name
        product_attribute_items {
          display_value
          attribute_item_value
          attribute_item_id
        }
      }
    }
  }
`;

export const GET_PRODUCT = gql`
  query GetProduct($id: Int!) {
    product(id: $id) {
      id
      product_uid
      name
      in_stock
      category_name
      brand
      description
      product_gallery
      product_prices {
        amount
        currency_label
        currency_symbol
      }
      product_attributes {
        attribute_id
        type
        name
        product_attribute_items {
          display_value
          attribute_item_value
          attribute_item_id
        }
      }
    }
  }
`;
