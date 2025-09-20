import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-react";
import {
    Button,
    Card,
    ColorInput,
    ColorPicker,
    Container,
    Grid,
    Group,
    Input,
    InputWrapper,
    PasswordInput,
    Select,
    Textarea,
    TextInput,
    Title,
} from "@mantine/core";
import React, { useState } from "react";
import ColorSelectInput from "../../Components/Input/ColorSelectInput";

const Create = () => {
    // const { category,attr } = usePage().props;

    const { data, setData, post, errors } = useForm({
        title: "",
        color: null,
        type: "0",
    });

    function handleChange(e) {
        setData(e.target.id, e.target.value);
    }

    const Action = (e) => {
        e.preventDefault();

        post(route("attribute.store"));
    };

    return (
        <Container size="xl">
            <Title order={3} my="lg">
                {" "}
                Tambah Attribute{" "}
            </Title>
            <form onSubmit={Action}>
                <Card radius="md" withBorder px={"2em"} py={"3em"}>
                    <Grid gutter="xl">
                        <Grid.Col md={7} lg={8}>
                            {/* Title Product */}
                            <TextInput
                                label="Label"
                                id="title"
                                description={
                                    "Labeling Nama Attribute Yang Akan Di Buat"
                                }
                                placeholder={"Eg : Biru Tosca"}
                                error={errors.title}
                                value={data.title}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        <Grid.Col md={7} lg={8}>
                            {/* Title Product */}
                            <Select
                                label="Tipe"
                                description="Pilih Tipe Attribute Untuk Produk Mu"
                                placeholder="Pick one"
                                value={data.type}
                                data={[
                                    { value: "0", label: "Color" },
                                    { value: "1", label: "Size" },
                                    { value: "2", label: "Motif" },
                                ]}
                                onChange={(e) => setData("type", e)}
                            />
                        </Grid.Col>

                        {/* if data color show the color option */}
                        {data.type === 0 && (
                            <Grid.Col md={7} lg={8}>
                                {/* Title Product */}
                                <ColorInput
                                    label="Color"
                                    format="hex"
                                    swatches={[
                                        "#25262b",
                                        "#868e96",
                                        "#fa5252",
                                        "#e64980",
                                        "#be4bdb",
                                        "#7950f2",
                                        "#4c6ef5",
                                        "#228be6",
                                        "#15aabf",
                                        "#12b886",
                                        "#40c057",
                                        "#82c91e",
                                        "#fab005",
                                        "#fd7e14",
                                    ]}
                                    onChange={(c) => setData("color", c)}
                                />
                            </Grid.Col>
                        )}

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
