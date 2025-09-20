import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-react";
import {
    Button,
    Card,
    Container,
    Grid,
    Textarea,
    TextInput,
    Title,
} from "@mantine/core";
import React, { useState } from "react";
import ColorSelectInput from "../../Components/Input/ColorSelectInput";

const Create = () => {
    // const { category,attr } = usePage().props;

    const { data, setData, post, errors } = useForm({
        reciver_name: "",
        no_telp: "",
        disctrict: "",
        city: "",
        zip_code: "",
        map_link_location: "",
        description: "",
    });

    function handleChange(e) {
        setData(e.target.id, e.target.value);
    }

    const Action = (e) => {
        e.preventDefault();

        post(route("address.store"));
    };

    return (
        <Container size="xl">
            <Title order={3} my="lg">
                Tambah Alamat
            </Title>
            <form onSubmit={Action}>
                <Card radius="md" withBorder px={"2em"} py={"3em"}>
                    <Grid gutter="xl">
                        <Grid.Col md={7} lg={8}>
                            <TextInput
                                label="Nama Penerima"
                                id="reciver_name"
                                description={"Nama Yang Akan Menerima Paket Mu"}
                                error={errors.title}
                                value={data.reciver_name}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        <Grid.Col md={7} lg={8}>
                            <TextInput
                                label="Nomor Telphone"
                                id="no_telp"
                                error={errors.no_telp}
                                value={data.no_telp}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        <Grid.Col md={7} lg={8}>
                            <TextInput
                                label="Kota/Kabupaten"
                                id="city"
                                error={errors.city}
                                value={data.city}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        <Grid.Col md={7} lg={8}>
                            <TextInput
                                label="Kecamatan"
                                id="disctrict"
                                error={errors.disctrict}
                                value={data.disctrict}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        <Grid.Col md={7} lg={8}>
                            <TextInput
                                label="Map Link"
                                id="map_link_location"
                                description={
                                    "Lokasi Di Map Kamu Pastikan Kopi Urlnya dengan full"
                                }
                                error={errors.map_link_location}
                                value={data.map_link_location}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        <Grid.Col md={7} lg={8}>
                            <TextInput
                                label="Kode Zip"
                                id="zip_code"
                                error={errors.zip_code}
                                value={data.zip_code}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        <Grid.Col md={7} lg={8}>
                            <Textarea
                                label="description"
                                id="description"
                                error={errors.description}
                                value={data.description}
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        <Grid.Col style={{ display: "flex" }}>
                            <Button color={"orange"} ml="auto" type="submit">
                                Tambah
                            </Button>
                        </Grid.Col>
                    </Grid>
                </Card>
            </form>
        </Container>
    );
};

export default Create;
