import React from "react";
import { Table, Card, Button } from "@mantine/core";
import { usePage, Link } from "@inertiajs/inertia-react";

const Dashboard = () => {
    const { data } = usePage().props;
    return (
        <Card>
            <Table>
                <thead>
                    <tr>
                        <th>Status Pembelian</th>
                        <th>Total</th>
                        <th>Tanggal Pembelian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {data.map((value) => (
                        <tr key={value.id}>
                            <td>Under Construction</td>
                            <td>{value.price}</td>
                            <td>{value.date}</td>
                            <td>
                            <Button
                                color="orange"
                                component={Link}
                                href={route("transaction.show", value.id)}
                            >
                                Detail
                            </Button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </Table>
        </Card>
    );
};

export default Dashboard;
