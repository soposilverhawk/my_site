import React from "react";
import { Routes, Route, Navigate } from "react-router-dom";
import ROUTES from "./Routes";
import CategoryPage from "../pages/categoryPage/CategoryPage";
import ProductDetailsPage from "../pages/productDetailsPage/ProductDetailsPage";

function AppRoutes() {
  return (
    <Routes>
      <Route path={ROUTES.HOME} element={<Navigate to="/all" />} />
      <Route path={ROUTES.CATEGORY} element={<CategoryPage />} />
      <Route
        path={ROUTES.PRODUCTDETAILSPAGE}
        element={<ProductDetailsPage />}
      />
    </Routes>
  );
}

export default AppRoutes;
