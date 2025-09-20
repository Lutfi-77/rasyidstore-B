import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-react";
import {
    Button,
    Card,
    Container,
    Grid,
    Group,
    Input,
    InputWrapper,
    MultiSelect,
    PasswordInput,
    Select,
    Space,
    Textarea,
    TextInput,
    Title,
} from "@mantine/core";
import { formList } from "@mantine/form";
import React, { useState, useEffect } from "react";
import ColorSelectInput from "../../Components/Input/ColorSelectInput";
import SelectCard from "../../Components/Input/SelectCard";
import UploadPhoto from "../../Components/ListTable/UploadPhoto";
import ListForm from "./ListForm";

const VariantProd = [
    { description: " Size", title: "Size" },
    {
        description: "Variant Color Dan Size",
        title: "Color + Size",
    },
    {
        description: "Variant Motif Dan Size",
        title: "Motif + Size",
    },
];

const Edit = () => {
    const { category, attr, entry } = usePage().props;
    console.log(entry);

    const { data, setData, post, errors } = useForm({
        // title: "",
        link: entry.link,
        // 'media' : '',
        medias: [],
        _method: "PUT",
    });

    const handleChange = (e) => {
        setData(e.target.id, e.target.value);
    };

    const Action = (e) => {
        e.preventDefault();

        console.log(data);

        post(route("banner.update", entry.id), {
            forceFormData: true,
        });
    };

    const valueToString = (scaffold) => {
        return scaffold.map((e) => ({ value: `${e.value}`, label: e.label }));
    };

    return (
        <Container size="xl">
            <Title order={3} my="lg">
                Edit Banner
            </Title>
            <form onSubmit={Action}>
                <Card radius="md" withBorder px={"2em"} py={"3em"}>
                    <Grid gutter="xl">
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
                                defaultImage={[
                                    {
                                        src: "/storage/" + entry.path,
                                        id: entry.id,
                                    },
                                ]}
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

export default Edit;
