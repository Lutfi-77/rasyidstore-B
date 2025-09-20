import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-react";
import {
    Button,
    Card,
    Container,
    Grid,
    Space,
    TextInput,
    Title,
} from "@mantine/core";
import React, { useState, useEffect } from "react";
import UploadPhoto from "../../Components/ListTable/UploadPhoto";

const Create = () => {
    const { data, setData, post, errors } = useForm({
        // title: "",
        link: "",
        // 'media' : '',
        medias: [],
    });

    const handleChange = (e) => {
        setData(e.target.id, e.target.value);
    };

    const Action = (e) => {
        e.preventDefault();

        post(route("banner.store"), {
            preserveState: true,
            forceFormData: true,
        });
    };

    return (
        <Container size="xl">
            <Title order={3} my="lg">
                Tambah Banner
            </Title>
            <form onSubmit={Action}>
                <Card radius="md" withBorder px={"2em"} py={"3em"}>
                    <Grid gutter="xl">
                        {/* <Grid.Col md={6} lg={8}>
                            Title Product
                            <TextInput
                                label="Nama"
                                id="title"
                                error={errors.title}
                                value={data.title}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col> */}

                        <Grid.Col md={6} lg={8}>
                            {/* Title Product */}
                            <TextInput
                                label="Link"
                                id="link"
                                error={errors.link}
                                value={data.link}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        <Grid.Col md={6} lg={8}>
                            {/* Title Product */}
                            <UploadPhoto
                                setFiles={(e) => setData("medias", e)}
                                multiple={false}
                            />
                        </Grid.Col>
                    </Grid>
                </Card>

                <Button color={"orange"} mt="lg" type="submit" variant="filled">
                    Tambah
                </Button>
            </form>
            <Space h="3em" />
        </Container>
    );
};

export default Create;
