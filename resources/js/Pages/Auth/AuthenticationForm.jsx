import React from "react";
import { useToggle, upperFirst } from "@mantine/hooks";
import {
    TextInput,
    PasswordInput,
    Text,
    Paper,
    Group,
    PaperProps,
    Button,
    Divider,
    Checkbox,
    Anchor,
    Container,
} from "@mantine/core";
import { useForm } from "@inertiajs/inertia-react";
// import { GoogleButton, TwitterButton } from "../SocialButtons/SocialButtons";

const AuthenticationForm = (props) => {
    const [type, toggle] = useToggle("login", ["login", "register"]);

    const { data, setData, post, errors } = useForm({
        username: "",
        fullname: "",
        email: "",
        password: "",
        password_confirmation: "",
    });

    function handleChange(e) {
        setData(e.target.id, e.target.value);
    }

    const Action = (e) => {
        e.preventDefault();

        post(route(type === "login" ? "auth.login" : "auth.register"), {
            preserveState: false,
            preserveScroll: false,
        });
    };

    return (
        <Container size={420} my={40}>
            <Paper radius="md" p="xl" withBorder {...props}>
                <Text size="lg" weight={500}>
                    Welcome to Alrasyid, {type} with
                </Text>

                <Group grow mb="md" mt="md">
                    {/* <GoogleButton radius="xl">Google</GoogleButton> */}
                    {/* <TwitterButton radius="xl">Twitter</TwitterButton> */}
                </Group>

                {/* <Divider
                label="Or continue with email"
                labelPosition="center"
                my="lg"
            /> */}

                <form onSubmit={Action}>
                    <Group direction="column" grow>
                        {type === "register" && (
                            <TextInput
                                label="Fullname"
                                id="fullname"
                                placeholder="Eg : Jhon Doe"
                                value={data.fullname}
                                required
                                onChange={handleChange}
                            />
                        )}

                        {type === "register" && (
                            <TextInput
                                label="Username"
                                id="username"
                                placeholder="Eg : jhondoe"
                                error={errors.username}
                                value={data.username}
                                required
                                onChange={handleChange}
                            />
                        )}

                        <TextInput
                            required
                            label={type === "login" ? "Email " : "Email"}
                            placeholder={
                                type === "login" ? "" : "hello@alrasyid.com"
                            }
                            id="email"
                            value={data.email}
                            onChange={handleChange}
                            error={errors.email}
                        />
                        {type === "register" && <Divider label="Secure" />}

                        <PasswordInput
                            required
                            label="Password"
                            id="password"
                            placeholder="Your password"
                            value={data.password}
                            onChange={handleChange}
                            error={errors.password}
                        />
                        {type === "register" && (
                            <PasswordInput
                                required
                                label="Konfirmasi Password"
                                id="password_confirmation"
                                placeholder="Confirm Your Password"
                                value={data.password_confirmation}
                                onChange={handleChange}
                                error={errors.password_confirmation}
                            />
                        )}

                        {/* {type === "register" && (
                        <Checkbox
                            label="I accept terms and conditions"
                            checked={form.terms}
                            onChange={(event) =>
                                form.setFieldValue(
                                    "terms",
                                    event.currentTarget.checked
                                )
                            }
                        />
                    )} */}
                    </Group>

                    <Group position="apart" mt="xl">
                        <Anchor
                            component="button"
                            type="button"
                            color="gray"
                            onClick={() => toggle()}
                            size="xs"
                        >
                            {type === "register"
                                ? "Already have an account? Login"
                                : "Don't have an account? Register"}
                        </Anchor>
                        <Button type="submit">{upperFirst(type)}</Button>
                    </Group>
                </form>
            </Paper>
        </Container>
    );
};

AuthenticationForm.layout = (page) => <>{page}</>;
export default AuthenticationForm;
