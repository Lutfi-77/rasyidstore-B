import React from "react";

const IFRender = ({ state, children }) => {
    return <>{state && children}</>;
};

export const IFRenderState = ({ state, children }) => {
    if (state) return <>{children}</>;
    else return <></>;
};

export const IFRenderUndefined = ({ state, children }) => {
    if (typeof state !== "undefined") return <>{children}</>;
    else return <></>;
};

export default IFRender;
