import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';
import { Button, Card, Container, Grid, Input, InputWrapper, PasswordInput, TextInput, Title } from '@mantine/core'
import React, {useState} from 'react'

const Create = () => {

    const { errors } = usePage().props;

    const [values, setValues] = useState({
        username : '',
        password : '', 
        password_confirmation :  '',
        fullname : '',
        email : '',

    });

    function handleChange(e) { 
        setValues(values => ({
            ...values,
            [e.target.id] : e.target.value
        }));
    }


    const Action = (e) => {
        e.preventDefault();

        Inertia.post(route('users.store'),values,{preserveState : true});
    }


  return (

    <Container size="xl">
        <Title order={3} my="lg"> Tambah User </Title>
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

                    <Grid.Col style={{display : "flex"}}>
                        <Button color={'orange'} ml="auto" type="submit">
                            Tambah 
                        </Button>
                    </Grid.Col>
                </Grid>
            </form>
        </Card>
        </Container>
  )
}

export default Create