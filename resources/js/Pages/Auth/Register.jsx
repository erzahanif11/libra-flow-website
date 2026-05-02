import { useEffect } from "react";
import { Head, Link, useForm } from "@inertiajs/react";
import InputError from "@/Components/InputError"; // Tetap pake ini buat nampilin pesan error

export default function Register() {
    // 1. Logika asli Laravel Breeze
    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });

    useEffect(() => {
        return () => {
            reset("password", "password_confirmation");
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();
        // Langsung nembak ke controller bawaan Laravel
        post(route("register"));
    };

    return (
        <div className="w-full min-h-screen flex justify-center items-center bg-white font-primary">
            <Head title="Create Account" />

            <form
                onSubmit={submit}
                className="w-[390px] flex gap-8 flex-col justify-center items-center px-9"
            >
                <div className="text-center">
                    <h1 className="text-4xl">Create Your Account</h1>
                    <h3 className="text-sm text-gray-500 font-secondary mt-2">
                        Streamline your library management with a seamless flow.
                    </h3>
                </div>

                <div className="w-full flex flex-col gap-3 font-secondary">
                    {/* INPUT NAME */}
                    <div>
                        <input
                            type="text"
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}
                            className="w-full border-2 rounded border-gray-200 p-4 focus:border-tertiary focus:ring-0 outline-none transition-all"
                            placeholder="Enter full name"
                            required
                        />
                        {/* Menampilkan error jika name kosong/error dari Laravel */}
                        <InputError message={errors.name} className="mt-1" />
                    </div>

                    {/* INPUT EMAIL */}
                    <div>
                        <input
                            type="email"
                            value={data.email}
                            onChange={(e) => setData("email", e.target.value)}
                            className="w-full border-2 rounded border-gray-200 p-4 focus:border-tertiary focus:ring-0 outline-none transition-all"
                            placeholder="Enter email"
                            required
                        />
                        <InputError message={errors.email} className="mt-1" />
                    </div>

                    {/* INPUT PASSWORD */}
                    <div>
                        <input
                            type="password"
                            value={data.password}
                            onChange={(e) =>
                                setData("password", e.target.value)
                            }
                            className="w-full border-2 rounded border-gray-200 p-4 focus:border-tertiary focus:ring-0 outline-none transition-all"
                            placeholder="Enter password"
                            required
                        />
                        <InputError
                            message={errors.password}
                            className="mt-1"
                        />
                    </div>

                    {/* INPUT CONFIRM PASSWORD */}
                    <div>
                        <input
                            type="password"
                            value={data.password_confirmation}
                            onChange={(e) =>
                                setData("password_confirmation", e.target.value)
                            }
                            className="w-full border-2 rounded border-gray-200 p-4 focus:border-tertiary focus:ring-0 outline-none transition-all"
                            placeholder="Confirm password"
                            required
                        />
                        <InputError
                            message={errors.password_confirmation}
                            className="mt-1"
                        />
                    </div>
                </div>

                {/* TOMBOL REGISTER */}
                <button
                    disabled={processing}
                    className={`w-full text-white bg-tertiary py-4 rounded-3xl font-secondary font-semibold hover:opacity-90 transition-all ${processing ? "opacity-50 cursor-not-allowed" : ""}`}
                >
                    {processing ? "Creating Account..." : "Create Account"}
                </button>

                {/* LINK KE LOGIN BREEZE */}
                <h4 className="text-sm font-secondary">
                    Already have an account?{" "}
                    <Link
                        href={route("login")}
                        className="font-bold text-tertiary hover:underline"
                    >
                        Login
                    </Link>
                </h4>
            </form>
        </div>
    );
}
