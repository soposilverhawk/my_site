import DOMPurify from "dompurify";
import parse from "html-react-parser";
import { useMemo } from "react";

export function useParseHTML(html) {
  return useMemo(() => {
    if (!html) return null;
    return parse(DOMPurify.sanitize(html));
  }, [html]);
}
