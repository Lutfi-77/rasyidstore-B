import React from "react";
import { forwardRef } from "react";
import {
    MultiSelect,
    MultiSelectProps,
    Box,
    CloseButton,
    SelectItemProps,
    MultiSelectValueProps,
    createStyles,
} from "@mantine/core";
import ColorRound from "../Other/ColorRound";

function Value({ value, label, onRemove, classNames, meta, ...others }) {
    return (
        <div {...others}>
            <Box
                sx={(theme) => ({
                    display: "flex",
                    cursor: "default",
                    alignItems: "center",
                    backgroundColor:
                        theme.colorScheme === "dark"
                            ? theme.colors.dark[7]
                            : theme.white,
                    border: `1px solid ${
                        theme.colorScheme === "dark"
                            ? theme.colors.dark[7]
                            : theme.colors.gray[4]
                    }`,
                    paddingLeft: 10,
                    borderRadius: 4,
                })}
            >
                <Box mr={10}>
                    <ColorRound label="" color={meta.color} />
                </Box>
                <Box sx={{ lineHeight: 1, fontSize: 12 }}>{label}</Box>
                <CloseButton
                    onMouseDown={onRemove}
                    variant="transparent"
                    size={22}
                    iconSize={14}
                    tabIndex={-1}
                />
            </Box>
        </div>
    );
}

const Item = forwardRef(({ label, meta, value, ...others }, ref) => {
    return (
        <div ref={ref} {...others}>
            <Box sx={{ display: "flex", alignItems: "center" }}>
                <Box mr={10}>
                    <ColorRound color={meta.color} />
                </Box>

                <div>{label}</div>
            </Box>
        </div>
    );
});

const ColorSelectInput = ({ entries, label, placeholder, defaultValue }) => {
    return (
        <MultiSelect
            data={entries}
            limit={20}
            valueComponent={Value}
            itemComponent={Item}
            searchable
            defaultValue={defaultValue}
            placeholder={placeholder}
            label={label}
        />
    );
};

export default ColorSelectInput;
