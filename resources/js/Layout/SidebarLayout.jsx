import React, { useState } from "react";
import { Link } from "@inertiajs/inertia-react";

import { createStyles, Navbar, Group, Code, Image } from "@mantine/core";
import {
    BellRinging,
    Fingerprint,
    Key,
    Settings,
    TwoFA,
    DatabaseImport,
    Receipt2,
    SwitchHorizontal,
    Logout,
    Dashboard,
    Users,
    Tags,
    Package,
    ShoppingCart,
    Slideshow,
    Section,
    AddressBook,
    Apps,
} from "tabler-icons-react";

const useStyles = createStyles((theme, _params, getRef) => {
    const icon = getRef("icon");
    return {
        header: {
            paddingBottom: theme.spacing.md,
            marginBottom: theme.spacing.md * 1.5,
            borderBottom: `1px solid ${
                theme.colorScheme === "dark"
                    ? theme.colors.dark[4]
                    : theme.colors.gray[2]
            }`,
        },

        footer: {
            paddingTop: theme.spacing.md,
            marginTop: theme.spacing.md,
            borderTop: `1px solid ${
                theme.colorScheme === "dark"
                    ? theme.colors.dark[4]
                    : theme.colors.gray[2]
            }`,
        },

        link: {
            ...theme.fn.focusStyles(),
            display: "flex",
            alignItems: "center",
            textDecoration: "none",
            fontSize: theme.fontSizes.sm,
            color:
                theme.colorScheme === "dark"
                    ? theme.colors.dark[1]
                    : theme.colors.gray[7],
            padding: `${theme.spacing.xs}px ${theme.spacing.sm}px`,
            borderRadius: theme.radius.sm,
            fontWeight: 500,

            "&:hover": {
                backgroundColor:
                    theme.colorScheme === "dark"
                        ? theme.colors.dark[6]
                        : theme.colors.gray[0],
                color: theme.colorScheme === "dark" ? theme.white : theme.black,

                [`& .${icon}`]: {
                    color:
                        theme.colorScheme === "dark"
                            ? theme.white
                            : theme.black,
                },
            },
        },
        TitleLink: {
            marginLeft: "12px",
            marginTop: "19px",
            marginBottom: "12px",
            color: theme.colors.gray[6],
            fontSize: "0.9em",
            fontWeight: "bold",
        },

        linkIcon: {
            ref: icon,
            color:
                theme.colorScheme === "dark"
                    ? theme.colors.dark[2]
                    : theme.colors.gray[6],
            marginRight: theme.spacing.sm,
        },

        linkActive: {
            "&, &:hover": {
                backgroundColor:
                    theme.colorScheme === "dark"
                        ? theme.fn.rgba(
                              theme.colors[theme.primaryColor][8],
                              0.25
                          )
                        : theme.colors[theme.primaryColor][0],
                color:
                    theme.colorScheme === "dark"
                        ? theme.white
                        : theme.colors[theme.primaryColor][7],
                [`& .${icon}`]: {
                    color: theme.colors[theme.primaryColor][
                        theme.colorScheme === "dark" ? 5 : 7
                    ],
                },
            },
        },
    };
});

const data = [
    { link: route("dashboard"), label: "Dashboard", icon: Dashboard },
    { link: route("users.index"), label: "Users", icon: Users },
    { link: route("address.index"), label: "Address", icon: AddressBook },
    { label: "Product" },
    { link: route("product.index"), label: "List", icon: Package },
    { link: route("category.index"), label: "Category", icon: Tags },
    { link: route("attribute.index"), label: "Attribute", icon: Apps },
    { label: "Transaction" },
    { link: route("cart.index"), label: "Cart", icon: ShoppingCart },
    { link: route("transaction.index"), label: "Transaction", icon: Section },
    { label: "Settings" },
    { link: route("banner.index"), label: "Banner", icon: Slideshow },
];

const SidebarLayout = ({ opened, setOpened }) => {
    const { classes, cx } = useStyles();
    const [active, setActive] = useState("Billing");

    const links = data.map((item) =>
        typeof item.link === "undefined" ? (
            <div className={classes.TitleLink}>{item.label}</div>
        ) : (
            <Link
                className={cx(classes.link, {
                    [classes.linkActive]: item.label === active,
                })}
                href={item.link}
                key={item.label}
                onClick={(event) => {
                    setOpened((e) => !e);
                    setActive(item.label);
                }}
            >
                <item.icon className={classes.linkIcon} />
                <span>{item.label}</span>
            </Link>
        )
    );

    return (
        <Navbar height={"100%"} width={{ sm: 300 }} p="md" hidden={!opened}>
            <Navbar.Section grow>
                <Group className={classes.header} position="apart">
                    {/* <MantineLogo /> */}
                    {/* <Code sx={{ fontWeight: 700 }}>v3.1.2</Code> */}
                </Group>
                {links}
            </Navbar.Section>

            <Navbar.Section className={classes.footer}>
                <a
                    href="#"
                    className={classes.link}
                    onClick={(event) => event.preventDefault()}
                >
                    <Logout className={classes.linkIcon} />
                    <span>Logout</span>
                </a>
            </Navbar.Section>
        </Navbar>
    );
};

export default SidebarLayout;
