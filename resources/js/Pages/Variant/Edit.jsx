import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';
import { Button, Card, Container, Grid, Input, InputWrapper, PasswordInput, TextInput, Title } from '@mantine/core'
import React, {useState,useEffect} from 'react'

const Edit = (props) => {

    const { errors, entry,id } = usePage().props;

    const [values, setValues] = useState({
        username : '',
        password : '', 
        password_confirmation :  '',
        fullname : '',
        email : '',
    });

    useEffect(() => {
        setValues(values => ({
                ...values,
                ...entry
        }));
    },[]);

    function handleChange(e) { 
        setValues(values => ({
            ...values,
            [e.target.id] : e.target.value
        }));
    }


    const Action = (e) => {
        e.preventDefault();

        Inertia.put(route('users.update',id),values,{preserveState : true});
    }


  return (

    <Container size="xl">
        <Title order={3} my="lg"> Edit User </Title>
        <Card  radius="md" withBorder px={"2em"} py={"3em"}>
            <form onSubmit={Action}>
                {/* Username */}

                <Grid  gutter="xl">

                    <Grid.Col md={6} lg={8} >

                    <TextInput
                            label="Username"

                            id="username"
                            error={errors.username}
                            value={values.username}
                            required
                            onChange={handleChange}
                            />

                    </Grid.Col>

                    <Grid.Col md={6} lg={5}>

                        <TextInput
                            label="Fullname"
                            id="fullname"
                            error={errors.fullname}
                            value={values.fullname}
                            required
                            onChange={handleChange}
                        />

                    </Grid.Col>


                <Grid.Col md={7}>

                <TextInput
                    label="Email"
                    id="email"
                    error={errors.email}
                    value={values.email}
                    required
                    onChange={handleChange}
                    />
                </Grid.Col>

                <Grid.Col md={6} >

                    <PasswordInput
                        placeholder="Password"
                        label="Password"
                        description="Password must include at least one letter, number and minimal 8 character"
                        id="password"
                        error={errors.password}
                        value={values.password}
                        onChange={handleChange}
                    />

                </Grid.Col>

                <Grid.Col md={6}>

                    <PasswordInput
                        placeholder="Confirm Password"
                        label="Password"
                        id="password_confirmation"
                        error={errors.password_confirmation}
                        value={values.password_confirmation}
                        onChange={handleChange}
                    />

                </Grid.Col>

                    <Grid.Col style={{display : "flex"}}>
                        <Button color={'orange'} ml="auto" type="submit">
                            Edit 
                        </Button>
                    </Grid.Col>
                </Grid>
            </form>
        </Card>
        </Container>
  )
}

export default Edit