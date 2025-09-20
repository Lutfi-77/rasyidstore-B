import React, { useContext, createContext } from "react";

const ListContext = createContext({});

const ListProvider = ({children,value}) => {
    return (
        <ListContext.Provider value={value}>
            {children}
        </ListContext.Provider>
    );
}

export {ListContext};

export default ListProvider;
