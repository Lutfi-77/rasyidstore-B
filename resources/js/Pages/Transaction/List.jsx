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
    Modal,
    Input,
    Button,
} from "@mantine/core";
import { useModals } from "@mantine/modals";
import React, { useCallback, useState } from "react";
import {
    Check,
    Edit,
    Pencil,
    ReceiptTax,
    Trash,
    User,
    X,
} from "tabler-icons-react";
import ListTable from "../../Components/ListTable";
import ColorRound from "../../Components/Other/ColorRound";
import IFRender, { IFRenderState } from "../../Components/Other/IFRender";
// import { AttributeType } from '../../variable';

const useStyles = createStyles((theme) => ({
    wrapper: {
        width: "100%",
    },
}));

const namespace = "transaction";

const TableHeader = () => (
    <tr>
        <th>User</th>
        <th>Nama Penerima</th>
        <th>Total Bayar</th>
        <th>Action</th>
    </tr>
);

const List = () => {
    const { classes, cx } = useStyles();
    const { data } = usePage().props;
    const [opened, setOpened] = useState(false);
    const [resi, setResi] = useState("");
    const [id, setId] = useState(0);

    console.log(data);
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
                    Inertia.delete(
                        route(namespace + ".update", {
                            id: id,
                            state: "decline",
                        })
                    );
                },
            }),
        []
    );

    const rows = (entry) => (
        <tr key={entry.id}>
            <td>{entry.user.fullname}</td>
            <td>
                {entry.address.reciver_name} ({entry.address.no_telp})
            </td>
            <td>{entry.total_amounts}</td>
            <td>
                <Group>
                    <IFRenderState state={entry.state === 0}>
                        <ActionIcon
                            component={Link}
                            href={route(namespace + ".update", entry.id)}
                            data={{ state: 1 }}
                            method="PUT"
                            color="green"
                            variant="outline"
                        >
                            <Check size={16} />
                        </ActionIcon>

                        <ActionIcon
                            color="red"
                            variant="outline"
                            onClick={ConfirmDeleteModal(entry.id)}
                        >
                            <X size={16} />
                        </ActionIcon>
                    </IFRenderState>
                    <IFRenderState state={entry.state === 1}>
                        <ActionIcon
                            // component={div}
                            onClick={(e) => {
                                setOpened(true);
                                setId(entry.id);
                            }}
                            color="orange"
                            variant="outline"
                        >
                            <ReceiptTax size={16} />
                        </ActionIcon>
                    </IFRenderState>
                    <IFRenderState state={entry.state === 2}>
                        <Text color={"blue"}>Delivery</Text>
                    </IFRenderState>
                </Group>
            </td>
        </tr>
    );

    return (
        <>
            <Container className={classes.wrapper} size="xl">
                <ListTable
                    cbElement={rows}
                    ElementHead={TableHeader}
                    data={data}
                    title={"Transaction"}
                    routeName={namespace + ".index"}
                    length={data.last_page}
                    // routeCreateName={namespace + ".create"}
                />
            </Container>

            <Modal
                opened={opened}
                onClose={() => setOpened(false)}
                title="Input Resi Anda"
            >
                {/* Modal content */}
                <Input
                    onChange={(e) => {
                        setResi(e.target.value);
                    }}
                    value={resi}
                />

                <Button
                    component={Link}
                    href={route(namespace + ".update", id)}
                    data={{ state: 3 }}
                    method="PUT"
                    color="blue"
                    variant="outline"
                    mt="lg"
                    onClick={(e) => setOpened(false)}
                >
                    Input Resi
                </Button>
            </Modal>
        </>
    );
};

export default List;
