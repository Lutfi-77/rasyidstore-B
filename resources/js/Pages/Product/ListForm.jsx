import {
    ActionIcon,
    Box,
    Button,
    Grid,
    Group,
    NumberInput,
    TextInput,
    Text,
    Select,
    Switch,
} from "@mantine/core";
import React from "react";
import { Trash } from "tabler-icons-react";
import ColorSelectInput from "../../Components/Input/ColorSelectInput";

const ListForm = ({ variant, setVariant, variantChoose, attr }) => {
    const addFormList = () => {
        setVariant((v) => [
            ...v,
            {
                variant_id: 0,
                parent_id: 0,
                is_ready: true,
                stock: 0,
            },
        ]);
    };

    const setListForm = (index, name, value) => {
        console.log(name, value);
        let data = [...variant];
        data[index][name] = value;

        setVariant(data);
    };

    const deleteListForm = (index) => {
        let data = [...variant];

        data.splice(index, 1);

        setVariant(data);
    };

    const valueToString = (scaffold) => {
        return scaffold.map((e) => ({ value: `${e.value}`, label: e.label }));
    };

    const fields = variant.map(
        ({ price, stock, parent_id, variant_id, is_ready }, index) => (
            <Group key={index} mt={index === 0 ? "xs" : "lg"}>
                {/* Variant */}
                {variantChoose !== 0 && (
                    <>
                        {variantChoose === 1 && (
                            <Select
                                data={valueToString(attr.color)}
                                searchable
                                label="Color"
                                value={`${parent_id}`}
                                onChange={(v) =>
                                    setListForm(index, "parent_id", v)
                                }
                                placeholder={"Color"}
                            />
                        )}

                        {variantChoose === 2 && (
                            <Select
                                label="Motive"
                                data={valueToString(attr.motive)}
                                searchable
                                value={`${parent_id}`}
                                onChange={(v) =>
                                    setListForm(index, "parent_id", v)
                                }
                                placeholder={"Motif"}
                            />
                        )}
                    </>
                )}

                <Select
                    data={valueToString(attr.size)}
                    value={`${variant_id}`}
                    onChange={(v) => setListForm(index, "variant_id", v)}
                    searchable
                    label="Size"
                    placeholder={"Pilih Size"}
                />

                {/* End Variant */}

                {/* Price */}
                <NumberInput
                    onChange={(v) => setListForm(index, "price", v)}
                    value={price}
                    label="Price"
                    parser={(value) => value.replace(/\R\p\.\s?|(,*)/g, "")}
                    formatter={(value) =>
                        !Number.isNaN(parseFloat(value))
                            ? `Rp. ${value}`.replace(
                                  /\B(?=(\d{3})+(?!\d))/g,
                                  ","
                              )
                            : "Rp. "
                    }
                />

                {/* Stock */}
                <NumberInput
                    placeholder="John Doe"
                    label="Stock"
                    ac
                    sx={{ flex: 1 }}
                    value={stock}
                    onChange={(v) => setListForm(index, "stock", v)}
                />

                {/* Is Ready */}
                <Switch
                    label="ready"
                    checked={is_ready}
                    onChange={(e) =>
                        setListForm(index, "is_ready", e.currentTarget.checked)
                    }
                />

                <ActionIcon
                    color="red"
                    variant="hover"
                    onClick={() => deleteListForm(index)}
                >
                    <Trash size={16} />
                </ActionIcon>
            </Group>
        )
    );

    return (
        <Grid gutter="xl" mt="lg">
            <Box mr="auto" ml="sm">
                {fields.length > 0 ? (
                    <Group mb="xs">
                        {/* <Text weight={500} size="sm" sx={{ flex: 1 }}>
                            Variant
                        </Text> */}
                        {/* <Text weight={500} size="sm" pr={90}>
                            Photo
                        </Text> */}
                    </Group>
                ) : (
                    <Text color="dimmed" align="center">
                        No one here...
                    </Text>
                )}

                {fields}

                <Group position="left" mt="md">
                    <Button theme="" onClick={() => addFormList()}>
                        Tambah Variant
                    </Button>
                </Group>
            </Box>
            {/* 0 : Mean Hide The Color And Motive */}
        </Grid>
    );
};

export default ListForm;
