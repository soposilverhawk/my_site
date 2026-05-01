import React from "react";
import { StyledActionButton } from "./ActionButton.styles";

function ActionButton({ variant, children, onclick, disabled }) {
  return (
    <StyledActionButton
      $variant={variant}
      onClick={onclick}
      disabled={disabled}
      data-testid={variant === "add-to-cart" ? "add-to-cart" : "place-order"}
    >
      {children}
    </StyledActionButton>
  );
}

export default ActionButton;
