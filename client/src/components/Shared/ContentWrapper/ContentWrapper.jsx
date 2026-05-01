import React from 'react';
import { Wrapper } from './ContentWrapper.styles';

function ContentWrapper({children}) {
  return (
    <Wrapper>
        {children}
    </Wrapper>
  )
}

export default ContentWrapper
