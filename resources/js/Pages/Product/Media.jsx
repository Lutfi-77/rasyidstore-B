import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-react";
import {
    Button,
    Card,
    Container,
    Grid,
    InputWrapper,
    Space,
    TextInput,
    Title,
} from "@mantine/core";
import { formList } from "@mantine/form";
import React, { useState, useEffect } from "react";
import UploadPhoto from "../../Components/ListTable/UploadPhoto";
import ColorRound from "../../Components/Other/ColorRound";
import { IFRenderState } from "../../Components/Other/IFRender";

const Media = () => {
    const { category, attributes, entry, medias } = usePage().props;
    console.log(entry);

    const { data, setData, post, errors } = useForm({
        // 'media' : '',

        medias: [],
        _method: "PUT",
    });

    const handleChange = (index, variant_id, files) => {
        var arr = [...data.medias];

        arr[index] = { variant_id, files };
        setData("medias", arr);
    };

    const Action = (e) => {
        e.preventDefault();

        console.log(data);

        post(route("media.update", entry.id), {
            forceFormData: true,
        });
    };

    const valueToString = (scaffold) => {
        return scaffold.map((e) => ({ value: `${e.value}`, label: e.label }));
    };

    return (
        <Container size="xl">
            <Title order={3} my="lg">
                Media Produk
            </Title>
            <form onSubmit={Action}>
                <Card radius="md" withBorder px={"2em"} py={"3em"}>
                    <Grid gutter="xl">
                        <Grid.Col md={6} lg={8}>
                            {/* Title Product */}
                            <TextInput
                                label="Nama"
                                id="title"
                                readOnly
                                color="gray"
                                value={entry.title}
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
                    <Title order={4}> Variant Produk </Title>

                    <InputWrapper
                        label="Variant Produk"
                        description="Masukan Gambar Sesuai Variasi Produk, jika tidak ada gambar gambar yang di pakai akan default awalbn"
                        mt="lg"
                        mb="lg"
                    >
                        <Grid>
                            {attributes.map((c, index) => (
                                <Grid.Col sm={12} mt={"lg"}>
                                    <IFRenderState state={c.type === 0}>
                                        <ColorRound
                                            color={c.meta_attr.color}
                                            title={c.title}
                                        />
                                    </IFRenderState>

                                    <IFRenderState state={c.type > 0}>
                                        <Title order={5}>{c.title}</Title>
                                    </IFRenderState>
                                    <Space h="md" />
                                    <UploadPhoto
                                        setFiles={(e) =>
                                            handleChange(index, c.id, e)
                                        }
                                        multiple={true}
                                        disabledDelete={false}
                                        defaultImage={medias[c.id]}
                                    />
                                </Grid.Col>
                            ))}
                        </Grid>
                    </InputWrapper>
                </Card>
                <Button color={"orange"} mt="lg" type="submit" variant="filled">
                    Tambah
                </Button>
            </form>
            <Space h="3em" />
        </Container>
    );
};

export default Media;
