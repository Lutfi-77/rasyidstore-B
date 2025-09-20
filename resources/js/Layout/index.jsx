import {
    AppShell,
    Aside,
    createStyles,
    Footer,
    Global,
    Header,
    MantineProvider,
    MediaQuery,
    useMantineTheme,
    Text,
    Navbar,
    Burger,
} from "@mantine/core";
import { ModalsProvider } from "@mantine/modals";
import React, { useState } from "react";
import SidebarLayout from "./SidebarLayout";

const useStyles = createStyles((theme) => ({
    wrapper: {
        height: "100%",
        display: "flex",
    },
    column: {
        height: "100%",
    },
    main: {
        width: "100%",
    },
}));
const index = (page) => {
    const { classes } = useStyles();
    const theme = useMantineTheme();
    const [opened, setOpened] = useState(false);
    return (
        <>
            <Global
                styles={(theme) => ({
                    body: {
                        ...theme.fn.fontStyles(),
                        backgroundColor:
                            theme.colorScheme === "dark"
                                ? theme.colors.dark[7]
                                : theme.colors.gray[1],
                        color:
                            theme.colorScheme === "dark"
                                ? theme.colors.dark[0]
                                : theme.black,
                        lineHeight: theme.lineHeight,
                        width: "100%",
                    },
                })}
            />

            <MantineProvider
                theme={{
                    // Override any other properties from default theme
                    fontFamily: "Open Sans, sans serif",
                }}
            >
                <ModalsProvider>
                    <AppShell
                        styles={{
                            main: {
                                background:
                                    theme.colorScheme === "dark"
                                        ? theme.colors.dark[8]
                                        : theme.colors.gray[0],
                            },
                        }}
                        navbarOffsetBreakpoint="sm"
                        asideOffsetBreakpoint="sm"
                        fixed
                        navbar={
                            <SidebarLayout
                                opened={opened}
                                setOpened={setOpened}
                            />
                        }
                        header={
                            <Header height={70} p="md">
                                <div
                                    style={{
                                        display: "flex",
                                        alignItems: "center",
                                        height: "100%",
                                    }}
                                >
                                    <MediaQuery
                                        largerThan="sm"
                                        styles={{ display: "none" }}
                                    >
                                        <Burger
                                            opened={opened}
                                            onClick={() => setOpened((o) => !o)}
                                            size="sm"
                                            color={theme.colors.gray[6]}
                                            mr="xl"
                                        />
                                    </MediaQuery>

                                    <Text>Application header</Text>
                                </div>
                            </Header>
                        }
                    >
                        {page}
                    </AppShell>
                </ModalsProvider>
            </MantineProvider>
        </>
    );
};

export default index;
