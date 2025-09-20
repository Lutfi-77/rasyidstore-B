import { Inertia } from "@inertiajs/inertia";
import { Link, usePage } from "@inertiajs/inertia-react";
import {
    ActionIcon,
    Badge,
    Card,
    Container,
    createStyles,
    Group,
    Pagination,
    Table,
    Text,
    Title,
    Image,
} from "@mantine/core";
import { useModals } from "@mantine/modals";
import React, { useCallback } from "react";
import { Edit, Pencil, Trash } from "tabler-icons-react";
import ListTable from "../../Components/ListTable";
import ColorRound from "../../Components/Other/ColorRound";
// import { AttributeType } from '../../variable';

const AttributeType = ["Color", "Size", "Motif"];
const useStyles = createStyles((theme) => ({
    wrapper: {
        width: "100%",
    },
}));

const namespace = "discount";

const TableHeader = () => (
    <tr>
        <th>Nama</th>
        <th>Value</th>
        <th>Action</th>
    </tr>
);

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
                    console.log("");
                },
                onConfirm: () => {
                    Inertia.delete(route(namespace + ".destroy", id));
                },
            }),
        []
    );

    const rows = (entry) => (
        <tr key={entry.id}>
            <td>{entry.title}</td>
            <td>{entry.value}</td>
            <td>
                <Group>
                    <ActionIcon
                        component={Link}
                        href={route(namespace + ".edit", entry.id)}
                        color="yellow"
                        variant="outline"
                    >
                        <Pencil size={16} />
                    </ActionIcon>

                    <ActionIcon
                        color="red"
                        variant="outline"
                        onClick={ConfirmDeleteModal(entry.id)}
                    >
                        <Trash size={16} />
                    </ActionIcon>
                </Group>
            </td>
        </tr>
    );

    return (
        <Container className={classes.wrapper} size="xl">
            <ListTable
                cbElement={rows}
                ElementHead={TableHeader}
                data={data}
                title={"Category"}
                routeName={namespace + ".index"}
                length={data.last_page}
                routeCreateName={namespace + ".create"}
            />
        </Container>
    );
};

export default List;
