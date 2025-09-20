import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-react";
import {
    Button,
    Card,
    ColorInput,
    ColorPicker,
    Container,
    Divider,
    Grid,
    Group,
    Input,
    InputWrapper,
    PasswordInput,
    Select,
    Text,
    Textarea,
    TextInput,
    Title,
} from "@mantine/core";
import React, { useState, useEffect } from "react";
import ColorSelectInput from "../../Components/Input/ColorSelectInput";
import TransactionCard from "../../Components/Other/TransactionCard";
import NumCounter from "../../Components/Input/NumCounter";
import _ from "lodash";

const Create = () => {
    const { items, addresses, source } = usePage().props;

    const [address, setAddress] = useState(addresses[0]);
    const [variant, setVariant] = useState({});

    console.log(addresses);

    const { data, setData, post, errors } = useForm({
        variant: {},
        address: addresses[0].id,
        source,
    });

    // Effect Handler
    useEffect(() => {
        let variantMap = {};

        items.forEach((v) => {
            variantMap[v.id] = v.quantity;
        });

        setVariant(variantMap);
    }, []);

    useEffect(() => {
        setData("variant", variant);
    }, [variant]);

    useEffect(() => {
        setData("address", address.id);
    }, [address]);

    //

    function setQuantity(id, value) {
        setVariant((e) => {
            var c = { ...e, ...{ [id]: value } };
            return c;
        });
    }

    const Action = (e) => {
        e.preventDefault();

        post(route("transaction.store"));
    };

    return (
        <Container size="xl">
            <Title order={3} mt="lg" mb="sm">
                Checkout Transaksi
            </Title>

            <Text color="gray" size="sm" mb="lg">
                Jangan Lupa Yaa, Pastikan Semua Barang Yang Anda Beli Tercatat
                Di Transaksi Ini
            </Text>

            <form onSubmit={Action}>
                <Card radius="md" withBorder px={"2em"} py={"2em"} mt="lg">
                    <Title order={5} mb="md">
                        Alamat Tujuan
                    </Title>

                    <Card
                        withBorder
                        radius={"md"}
                        shadow="xs"
                        // styles={{ width: "100%" }}
                    >
                        <Select
                            placeholder="Pick one"
                            variant="unstyled"
                            styles={{
                                input: {
                                    fontWeight: 700,
                                },
                            }}
                            value={`${address.id}`}
                            onChange={(e) => {
                                // Set Address find id Index
                                setAddress(
                                    addresses[
                                        addresses.findIndex(
                                            (c) => c.id === parseInt(e)
                                        )
                                    ]
                                );
                            }}
                            data={addresses.map((v) => {
                                return {
                                    value: `${v.id}`,
                                    label: `${v.reciver_name} (${v.no_telp})`,
                                };
                            })}
                        />
                        {/* <Title order={6}>Ikbl Mulyadi (08102909312)</Title> */}
                        <Text color={"gray"} mt="lg">
                            {address.city}, {address.disctrict}{" "}
                            {address.zip_code} {address.description}
                        </Text>
                    </Card>
                </Card>
                <Card radius="md" withBorder px={"2em"} py={"3em"} mt="lg">
                    <Title order={5} mb="md">
                        Barang yang dibeli
                    </Title>
                    {items.map((item) => {
                        // {
                        // console.log(item.variants.size.title);
                        // }
                        return (
                            <>
                                <Group>
                                    {" "}
                                    {console.log(items)}
                                    <TransactionCard
                                        image={item.image}
                                        title={item.title}
                                        price={item.price}
                                        color={item.variants.color}
                                        size={item.variants.size}
                                        other={item.variants.motif}
                                    />
                                    <div
                                        style={{
                                            width: "130px",
                                            marginLeft: "auto",
                                            marginTop: "1em",
                                        }}
                                    >
                                        <NumCounter
                                            onChange={(c) => {
                                                setQuantity(item.id, c);
                                            }}
                                            vals={variant[item.id]}
                                        />
                                    </div>
                                </Group>

                                <Divider my={"xl"} />
                            </>
                        );
                    })}
                    <Button type="submit" color="orange">
                        Pesan
                    </Button>
                </Card>
            </form>
        </Container>
    );
};
Create.layout = (page) => <>{page}</>;
export default Create;
