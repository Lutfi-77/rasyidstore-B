import { Inertia } from "@inertiajs/inertia";
import { Link, usePage } from "@inertiajs/inertia-react";
import {
    ActionIcon,
    Badge,
    Button,
    Card,
    Container,
    createStyles,
    Divider,
    Grid,
    Group,
    Pagination,
    Space,
    Table,
    Text,
    Title,
} from "@mantine/core";
import { useModals } from "@mantine/modals";
import React, { useCallback } from "react";
import { Edit, Pencil, Photo, Trash } from "tabler-icons-react";
import NumCounter from "../../Components/Input/NumCounter";
import ListTable from "../../Components/ListTable";
import TransactionCard from "../../Components/Other/TransactionCard";

const useStyles = createStyles((theme) => ({
    wrapper: {
        width: "100%",
    },
}));

const namespace = "product";

const List = () => {
    const { classes, cx } = useStyles();
    const { data } = usePage().props;
    const modals = useModals();

    const ConfirmDeleteModal = useCallback(
        (id) => () =>
            modals.openConfirmModal({
                title: "Do You Want To Delete ?",
                children: (
                    <Text size="sm">
                        Perhatian Jika Anda Mendelete Data Ini Tidak Akan Bisa
                        Dikembalikan
                    </Text>
                ),

                labels: { confirm: "Delete", cancel: "Cancel" },
                onCancel: () => {
                    console.log();
                },
                onConfirm: () => {
                    Inertia.delete(route(namespace + ".destroy", id));
                },
            }),
        []
    );

    return (
        <Container className={classes.wrapper} size="xl" mt="lg">
            <Title order={4} mb="lg">
                Cart
            </Title>
            {data.map((value) => (
                <>
                    <Group key={value.id}>
                        <TransactionCard
                            title={value.title}
                            price={value.price}
                            color={value.variants.color}
                            size={value.variants.size}
                        />
                        <div
                            style={{
                                width: "130px",
                                marginLeft: "auto",
                                marginTop: "1em",
                            }}
                        >
                            <NumCounter vals={value.qty} />
                        </div>
                    </Group>

                    <Divider my={"xl"} />
                </>
            ))}
            <Button
                color="orange"
                component={Link}
                href={route("transaction.create", { source: "cart" })}
            >
                Checkout
            </Button>
        </Container>
    );
};

export default List;
