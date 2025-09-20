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
    NumberInput,
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
        value: 0,
        desc: "",
    });

    function handleChange(e) {
        setData(e.target.id, e.target.value);
    }

    const Action = (e) => {
        e.preventDefault();

        post(route("discount.store"));
    };

    return (
        <Container size="xl">
            <Title order={3} my="lg">
                {" "}
                Tambah Discount{" "}
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
                            <NumberInput
                                error={errors.title}
                                value={data.title}
                                onChange={handleChange}
                                label="Price"
                                parser={(value) =>
                                    value.replace(/\R\p\.\s?|(,*)/g, "")
                                }
                                formatter={(value) =>
                                    !Number.isNaN(parseFloat(value))
                                        ? `Rp. ${value}`.replace(
                                              /\B(?=(\d{3})+(?!\d))/g,
                                              ","
                                          )
                                        : "Rp. "
                                }
                            />
                        </Grid.Col>

                        <Grid.Col md={7} lg={8}>
                            {/* Title Product */}
                            <Textarea
                                label="Description"
                                id="desc"
                                placeholder={""}
                                error={errors.desc}
                                value={data.desc}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        {/* if data color show the color option */}

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
