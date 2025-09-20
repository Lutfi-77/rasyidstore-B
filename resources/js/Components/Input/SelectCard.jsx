import React from "react";
import {
    UnstyledButton,
    Checkbox,
    Text,
    Image,
    SimpleGrid,
    createStyles,
    Radio,
} from "@mantine/core";
import { useUncontrolled } from "@mantine/hooks";

const useStyles = createStyles((theme) => ({
    button: {
        display: "flex",
        alignItems: "center",
        width: "100%",
        transition: "background-color 150ms ease, border-color 150ms ease",
        border: `1px solid ${theme.colors.gray[3]}`,
        borderRadius: theme.radius.sm,
        padding: theme.spacing.sm,
        backgroundColor: theme.white,
    },

    checked: {
        border: `1px solid ${theme.colors[theme.primaryColor][6]}`,
        backgroundColor: theme.colors[theme.primaryColor][0],
    },

    body: {
        flex: 1,
        marginLeft: theme.spacing.md,
    },
}));

const CardCheckbox = ({
    checked,
    defaultChecked,
    onChange,
    title,
    description,
    className,
    image,
    ...others
}) => {
    const [value, handleChange] = useUncontrolled({
        value: checked,
        defaultValue: defaultChecked,
        finalValue: false,
        onChange,
        rule: (val) => typeof val === "boolean",
    });

    const { classes, cx } = useStyles();

    return (
        <UnstyledButton
            {...others}
            onClick={() => handleChange(!value)}
            className={cx(classes.button, className)}
        >
            {/* <Image src={image} alt={title} width={40} /> */}

            <div className={classes.body}>
                <Text color="dimmed" size="xs" sx={{ lineHeight: 1 }} mb={5}>
                    {description}
                </Text>
                <Text weight={500} size="sm" sx={{ lineHeight: 1 }}>
                    {title}
                </Text>
            </div>

            <Radio
                checked={value}
                onChange={() => {}}
                tabIndex={-1}
                styles={{ input: { cursor: "pointer" } }}
            />
        </UnstyledButton>
    );
};

const mockdata = [
    { description: "Sun and sea", title: "Beach vacation" },
    { description: "Sightseeing", title: "City trips" },
    { description: "Mountains", title: "Hiking vacation" },
    { description: "Snow and ice", title: "Winter vacation" },
];

const SelectCard = ({
    data,
    onChange,
    checked,
    defaultChecked,
    className,
    ...others
}) => {
    const [value, handleChange] = useUncontrolled({
        value: checked,
        defaultValue: defaultChecked,
        finalValue: false,
        onChange,
        rule: (val) => typeof val === "boolean",
    });

    const { classes, cx } = useStyles({ checked: value });

    return (
        <SimpleGrid
            cols={4}
            breakpoints={[
                { maxWidth: "md", cols: 2 },
                { maxWidth: "sm", cols: 1 },
            ]}
        >
            {data.map(({ description, title }, index) => (
                <>
                    <UnstyledButton
                        {...others}
                        onClick={() => handleChange(index)}
                        className={cx(classes.button, className, {
                            [classes.checked]: index === value,
                        })}
                    >
                        <div className={classes.body}>
                            <Text weight={500} size="sm" sx={{ lineHeight: 1 }}>
                                {title}
                            </Text>
                            <Text
                                color="dimmed"
                                size="xs"
                                sx={{ lineHeight: 1 }}
                                mt={5}
                            >
                                {description}
                            </Text>
                        </div>

                        <Radio
                            checked={index === value}
                            onChange={() => {}}
                            tabIndex={-1}
                            styles={{ input: { cursor: "pointer" } }}
                        />
                    </UnstyledButton>
                </>
            ))}
        </SimpleGrid>
    );
};

export default SelectCard;
