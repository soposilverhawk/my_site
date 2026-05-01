import React from "react";
import { useQuery } from "@apollo/client/react";
import { StyledUL, StyledListItem } from "./HeaderNavigation.styles";
import { Link, useLocation } from "react-router-dom";
import capitalizeString from "../../utils/capitalizeString";
import { GET_CATEGORIES } from "../../api/queries";

function HeaderNavigation() {
  const { data, loading } = useQuery(GET_CATEGORIES);
  const location = useLocation();

  if (loading) return null;
  return (
    <StyledUL>
      {data.categories.map((cat) => {
        const isActive = location.pathname === `/${cat.name.toLowerCase()}`;

        return (
          <StyledListItem key={`${cat.name}-category-${cat.id}`}>
            <Link
              to={`/${cat.name.toLowerCase()}`}
              data-testid={isActive ? "active-category-link" : "category-link"}
            >
              {capitalizeString(cat.name)}
            </Link>
          </StyledListItem>
        );
      })}
    </StyledUL>
  );
}

export default HeaderNavigation;
