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
        title: entry.title,
        desc: entry.desc,
        category: `${entry.category_id}`,
        // 'media' : '',
        variant: [],
        variantChoose: entry.meta?.variantChoose,
        medias: [],
        _method: "PUT",
    });

    const [variant, setVariant] = useState([]);

    useEffect(() => {
        setVariant(entry.variant);
    }, []);

    useEffect(() => {
        setData("variant", variant);
    }, [variant]);

    const handleChange = (e) => {
        setData(e.target.id, e.target.value);
    };

    const Action = (e) => {
        e.preventDefault();

        console.log(data);

        post(route("product.update", entry.id), {
            forceFormData: true,
        });
    };

    const valueToString = (scaffold) => {
        return scaffold.map((e) => ({ value: `${e.value}`, label: e.label }));
    };

    return (
        <Container size="xl">
            <Title order={3} my="lg">
                {" "}
                Edit Produk{" "}
            </Title>
            <form onSubmit={Action}>
                <Card radius="md" withBorder px={"2em"} py={"3em"}>
                    <Grid gutter="xl">
                        <Grid.Col md={6} lg={8}>
                            {/* Title Product */}
                            <TextInput
                                label="Nama"
                                id="title"
                                error={errors.title}
                                value={data.title}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        {/* Category */}
                        <Grid.Col md={6} lg={8}>
                            <Select
                                label="Kategori"
                                error={errors.category}
                                value={data.category}
                                required
                                onChange={(c) => setData("category", c)}
                                multiple={true}
                                data={valueToString(category)}
                            />
                        </Grid.Col>

                        {/* Description */}
                        <Grid.Col md={6} lg={8}>
                            <Textarea
                                placeholder="Deskripsi"
                                label="Masukan Desripsi Produk..."
                                error={errors.desc}
                                value={data.desc}
                                id="desc"
                                onChange={handleChange}
                                required
                            />
                        </Grid.Col>

                        <Grid.Col md={6} lg={8}>
                            {/* Title Product */}
                            <UploadPhoto
                                setFiles={(e) => setData("medias", e)}
                                multiple={true}
                                defaultImage={entry.medias.map((e) => ({
                                    src: "/storage/" + e.file_path,
                                    id: e.id,
                                }))}
                            />
                        </Grid.Col>
                    </Grid>
                </Card>

                <Card
                    radius="md"
                    withBorder
                    pb={"2em"}
                    pt={"1.9em"}
                    px={"3em"}
                    mt="lg"
                >
                    {/* <Title order={4}> Variant Produk </Title> */}

                    {/* Edit Select Of Variant */}
                    {/* <InputWrapper
                        label="Variant"
                        description="Pilih Variant Yang Di ingin kan Maximal 2 Deepth"
                        mt="lg"
                        mb="lg"
                    > */}
                    {/* <Card>{VariantProd[]}</Card> */}
                    {/* </InputWrapper> */}

                    <InputWrapper
                        label="Pilih Variant"
                        description="Pilih Variant Yang Di Inginkan"
                        mt="lg"
                        mb="lg"
                    >
                        {/* Repeatable */}

                        <ListForm
                            attr={attr}
                            setVariant={setVariant}
                            variant={variant}
                            variantChoose={parseInt(entry.meta.variantChoose)}
                        />

                        {/* {console.log(entry.meta.varianChoose)} */}
                    </InputWrapper>
                </Card>
                <Button color={"orange"} mt="lg" type="submit" variant="filled">
                    Edit
                </Button>
            </form>
            <Space h="3em" />
        </Container>
    );
};

export default Edit;
