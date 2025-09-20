import { Avatar, Badge, Grid, Group, Text } from "@mantine/core";
import ColorRound from "./ColorRound";
import IFRenderUndefined from "./IFRender";

const TransactionCard = ({ image, title, price, color, size, other }) => {
    return (
        <Group noWrap>
            <Avatar src={image} size={94} radius="md" />
            <div>
                {/* <Text
                    size="xs"
                    sx={{ textTransform: "uppercase" }}
                    weight={700}
                    color="dimmed"
                >
                    {title}
                </Text> */}

                <Text size="md" weight={500} color={"gray"}>
                    {title}
                </Text>
                <Group mt="0.3em" mb="sm">
                    <IFRenderUndefined state={color}>
                        <Group noWrap spacing={10} mt={3}>
                            <ColorRound
                                color={color?.meta_attr.color}
                                title={color?.title}
                            />
                        </Group>
                    </IFRenderUndefined>

                    <IFRenderUndefined state={size}>
                        <Group noWrap spacing={10} mt={3}>
                            <Badge>{size?.title} </Badge>
                        </Group>
                    </IFRenderUndefined>

                    <IFRenderUndefined state={other}>
                        <Group noWrap spacing={10} mt={3}>
                            <Badge>{other?.title}</Badge>
                        </Group>
                    </IFRenderUndefined>
                </Group>

                <Group noWrap spacing={10} mt={3}>
                    <Text size="sm" color="gray">
                        {`Rp. ${price}`.replace(/\B(?=(\d{3})+(?!\d))/g, ",")}
                    </Text>
                </Group>
            </div>
        </Group>
    );
};

export default TransactionCard;
