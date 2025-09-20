import {
    Group,
    Text,
    useMantineTheme,
    MantineTheme,
    Image,
    Box,
    Grid,
    BackgroundImage,
    createStyles,
    ActionIcon,
} from "@mantine/core";
import {
    Upload,
    Photo,
    X,
    Icon as TablerIcon,
    Trash,
} from "tabler-icons-react";
import { Dropzone, DropzoneStatus, IMAGE_MIME_TYPE } from "@mantine/dropzone";
import { useState, useEffect, useCallback } from "react";
import { Inertia, usePage } from "@inertiajs/inertia-react";
import { useModals } from "@mantine/modals";

const useButtonStyles = createStyles((theme) => {
    return {
        ImageOverlay: {
            background: theme.colors.gray[3],
            opacity: 0,
            height: "7em",
            display: "flex",

            "&:hover": {
                opacity: 0.7,
            },
        },
    };
});

function getIconColor(status, theme) {
    return status.accepted
        ? theme.colors[theme.primaryColor][theme.colorScheme === "dark" ? 4 : 6]
        : status.rejected
        ? theme.colors.red[theme.colorScheme === "dark" ? 4 : 6]
        : theme.colorScheme === "dark"
        ? theme.colors.dark[0]
        : theme.colors.gray[7];
}

const ImageUploadIcon = ({ status, ...props }) => {
    if (status.accepted) {
        return <Upload {...props} />;
    }

    if (status.rejected) {
        return <X {...props} />;
    }

    return <Photo {...props} />;
};

const ListImage = ({ images, defaultImage, deleteImage, disabledDelete }) => {
    console.log(defaultImage, images);
    const defaultImages = [...images, ...defaultImage];
    const { classes, cx } = useButtonStyles();

    return (
        <Grid gap="lg">
            {defaultImages.map((image, index) => (
                <Grid.Col md={6} lg={2} key={index}>
                    <BackgroundImage src={image.src} radius="md">
                        <Box className={classes.ImageOverlay}>
                            <ActionIcon
                                variant="transparent"
                                onClick={() => deleteImage(image)}
                                color="red"
                                m="auto"
                                disabled={
                                    disabledDelete && image.type === "external"
                                }
                            >
                                <Trash size={16} />
                            </ActionIcon>
                        </Box>
                    </BackgroundImage>
                </Grid.Col>
            ))}
        </Grid>
    );
};

export const dropzoneChildren = (status, theme, image) => (
    <Group
        position="center"
        spacing="xl"
        style={{ minHeight: 220, pointerEvents: "none" }}
    >
        <ImageUploadIcon
            status={status}
            style={{ color: getIconColor(status, theme) }}
            size={80}
        />

        <div>
            <Text size="sm" inline>
                Drag images here or click to select files
            </Text>
            <Text size="xs" color="dimmed" inline mt={7}>
                file should not exceed 5mb
            </Text>
        </div>
    </Group>
);

const santizeDefaultImage = (defaultImage) => {
    return typeof defaultImage === "undefined"
        ? []
        : defaultImage.map((e) => ({
              src: e.src,
              id: e.id,
              type: "external",
          }));
};

function UploadPhoto({
    setFiles,
    loading,
    defaultImage,
    multiple,
    disabledDelete = true,
}) {
    const theme = useMantineTheme();
    const [photo, setPhoto] = useState([]);
    const [blob, setBlob] = useState([]);
    const [image, setImage] = useState(santizeDefaultImage(defaultImage));
    const { csrfToken } = usePage().props;
    const modals = useModals();

    const confirmDeleteImage = (image) => {
        modals.openConfirmModal({
            title: "Do You Want To Delete ?",
            children: (
                <Text size="sm">
                    {image.type === "blob"
                        ? "anda akan mendelete file yang akan di upload ke server"
                        : "anda akan mendelete image yang ada di server dan ini tidak bisa dikembalikan"}
                </Text>
            ),

            labels: { confirm: "Delete", cancel: "Cancel" },
            onCancel: () => {
                console.log();
            },
            onConfirm: () => {
                deleteImage(image);
            },
        });
    };

    const deleteImage = ({ src, type, id }) => {
        const filterImage = [...(type === "blob" ? blob : image)];
        const findIndex = filterImage.findIndex((o) => o.src === src);

        console.log(findIndex);

        filterImage.splice(findIndex, 1);

        console.log(filterImage);

        if (type === "external")
            fetch(route("media.destroy", { id }), {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            }).then(() => {
                setImage(filterImage);
            });

        if (type === "blob") setBlob(filterImage);
    };

    useEffect(() => {
        blob.map((p) => {
            URL.revokeObjectURL(p);
        });

        setFiles(photo);

        setBlob(
            photo.map((p) => {
                return { src: URL.createObjectURL(p), type: "blob" };
            })
        );
    }, [photo]);

    return (
        <>
            <Dropzone
                onDrop={(files) => setPhoto(files)}
                onReject={(files) => console.log("rejected files", files)}
                maxSize={3 * 1024 ** 2}
                accept={IMAGE_MIME_TYPE}
                multiple={multiple || false}
                loading={loading}
            >
                {(status) => dropzoneChildren(status, theme, defaultImage)}
            </Dropzone>

            <ListImage
                images={blob}
                defaultImage={image}
                deleteImage={confirmDeleteImage}
                disabledDelete={disabledDelete}
            />
        </>
    );
}

export default UploadPhoto;
