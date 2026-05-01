import { gql } from "@apollo/client";

export const PLACE_ORDER = gql`
  mutation PlaceOrder($items: [OrderItemInput!]!) {
    placeOrder(items: $items) {
      id
      total
      items {
        product_id
        qty
        price
        selected_options {
          name
          value
        }
      }
    }
  }
`;
