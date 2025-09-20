import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-react";
import {
    Button,
    Card,
    Container,
    Grid,
    Input,
    InputWrapper,
    PasswordInput,
    TextInput,
    Title,
} from "@mantine/core";
import React, { useEffect } from "react";
import UploadPhoto from "../../Components/ListTable/UploadPhoto";

const Edit = () => {
    const { id, entry } = usePage().props;

    const { setData, put, data, progress, errors, setDefaults } = useForm({
        title: "",
        banner: "",
    });

    function handleChange(e) {
        setData(e.target.id, e.target.value);
    }

    useEffect(() => {
        setData({
            title: entry.title,
            banner: entry.banner,
        });
    }, []);

    const Action = (e) => {
        e.preventDefault();

        console.log("gol");
        put(route("category.update", id), {
            forceFormData: true,
        });
    };

    return (
        <Container size="xl">
            <Title order={3} my="lg">
                {" "}
                Tambah Attribute{" "}
            </Title>
            <Card radius="md" withBorder px={"2em"} py={"3em"}>
                <form onSubmit={Action}>
                    {/* Title */}

                    <Grid gutter="xl">
                        <Grid.Col md={6} lg={8}>
                            <TextInput
                                label="Title"
                                id="title"
                                error={errors.title}
                                value={data.title}
                                required
                                onChange={handleChange}
                            />
                        </Grid.Col>

                        <Grid.Col md={6} lg={8}>
                            <UploadPhoto
                                setFiles={(file) => setData("banner", file[0])}
                                // loading={typeof progress === undefined}
                                loading={false}
                            />
                        </Grid.Col>

                        <Grid.Col style={{ display: "flex" }}>
                            <Button color={"orange"} ml="auto" type="submit">
                                Tambah
                            </Button>
                        </Grid.Col>
                    </Grid>
                </form>
            </Card>
        </Container>
    );
};

export default Edit;
