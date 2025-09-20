import { Badge, createStyles, Group, Text } from "@mantine/core";
import React from "react";

const useStyles = createStyles((theme) => ({
    colorBox: {
        width: "13px",
        height: "13px",
        borderRadius: "10px",
        borderWidth: 0.9,
        borderColor: theme.colors.gray[5],
        borderStyle: "solid",
    },
    badgeCustom: {
        borderWidth: "1.3px",
        borderColor: theme.colors.gray[3],
        borderStyle: "solid",
        background: "white",
    },
}));

const ColorRound = ({ color, title }) => {
    const styles = useStyles();
    return (
        <Badge className={styles.classes.badgeCustom}>
            <Group spacing={"sm"}>
                <span
                    style={{ background: color }}
                    className={styles.classes.colorBox}
                ></span>
                <Text size="xs">{title}</Text>
            </Group>
        </Badge>
    );
};

export default ColorRound;
