import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-react";
import {
    Button,
    Card,
    Container,
    createStyles,
    Grid,
    Pagination,
    Table,
    Text,
    TextInput,
    Title,
} from "@mantine/core";
import React, { useCallback, useState, useEffect } from "react";
import { Plus, Search } from "tabler-icons-react";
import ListProvider from "./ListProvider";
import PaginationList from "./PaginationList";
const useStyles = createStyles((theme) => ({
    wrapper: {
        width: "100%",
    },
}));
const ListTable = ({
    cbElement,
    ElementHead,
    title,
    routeName,
    data,
    length,
    routeCreateName,
}) => {
    // Hooks
    const { classes, cx } = useStyles();
    const [query, setQuery] = useState({});
    const [search, setSearch] = useState("");

    // Behavior
    const queryTable = useCallback((newQuery) => {
        // setup New Query
        setQuery((qry) => ({ ...qry, ...newQuery }));

        Inertia.get(route(routeName), newQuery, {
            replace: true,
            preserveState: true,
            only: ["data"],
        });
        // console.log(query,newQuery);
    }, []);

    useEffect(() => {
        if (query.length > 0)
            Inertia.get(route(routeName), newQuery, {
                replace: true,
                preserveState: true,
                only: ["data"],
            });
    }, [query]);

    const handleSearchChange = (event) => {
        const { value } = event.currentTarget;
        setSearch(value);

        queryTable({ page: 1, search: value });
    };

    const rows = data.map(cbElement);

    return (
        <ListProvider value={{ queryTable, query }}>
            <Container className={classes.wrapper}>
                <Title order={3} my="lg">
                    {" "}
                    {title}{" "}
                </Title>
                <Grid>
                    <Grid.Col md={12} lg={routeCreateName ? 10 : 12}>
                        <TextInput
                            placeholder="Search by any field"
                            mb="md"
                            icon={<Search size={14} />}
                            value={search}
                            onChange={handleSearchChange}
                        />
                    </Grid.Col>

                    {routeCreateName && (
                        <Grid.Col sm={2}>
                            <Button
                                color="orange"
                                component={Link}
                                href={route(routeCreateName)}
                                leftIcon={<Plus size={14} />}
                            >
                                Tambah
                            </Button>
                        </Grid.Col>
                    )}
                </Grid>
                <Card radius="lg" withBorder p={"xs"}>
                    <Table highlightOnHover>
                        <thead>
                            <ElementHead />
                        </thead>
                        <tbody>{rows}</tbody>
                    </Table>
                    <PaginationList length={length} />
                </Card>
            </Container>
        </ListProvider>
    );
};

export default ListTable;
